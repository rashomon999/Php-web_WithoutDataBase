package com.integrales

import kotlin.math.abs
import kotlin.math.cos
import kotlin.math.ln
import kotlin.math.max
import kotlin.math.pow
import kotlin.math.sin
import kotlin.math.sqrt
import kotlin.math.tan
import kotlin.random.Random

/**
 * Verificador de equivalencia matemática (estilo Symbolab).
 *
 * En lugar de comparar texto, convierte el LaTeX a una expresión evaluable y
 * comprueba numéricamente que la respuesta del usuario y la solución valen lo
 * mismo en muchos puntos aleatorios. Así "\frac{1}{3x^{-3}}+C", "x^3/3+C" y
 * "\frac{x^3}{3}+C" se aceptan todas sin listarlas a mano.
 */
object Algebra {

    private val FUNCIONES = listOf("sqrt", "abs", "sin", "cos", "tan", "sec", "csc", "cot", "ln")

    /**
     * ¿Representan a y b la misma antiderivada? (a y b ya normalizadas, sin "+c")
     *
     * Acepta también respuestas que difieren en una CONSTANTE (matemáticamente
     * ambas son antiderivadas válidas, ej. x+13Ln|x-8| y x-8+13Ln|x-8|):
     * comprueba que la diferencia a-b sea la misma en todos los puntos.
     */
    fun equivalentes(a: String, b: String): Boolean {
        val ta = try { conMultImplicita(tokens(prepara(a))) } catch (e: Exception) { return false }
        val tb = try { conMultImplicita(tokens(prepara(b))) } catch (e: Exception) { return false }
        if (ta.isEmpty() || tb.isEmpty()) return false

        val vars = (variables(ta) + variables(tb))
        val rnd = Random(20260723)
        val difs = mutableListOf<Double>()
        var escala = 1.0

        // Dos rangos de muestreo: algunos integrandos solo existen para x grande
        // (ej. sqrt(x^2-5) necesita x > √5)
        val rangos = listOf(0.3 to 1.9, 2.4 to 4.2)
        for ((lo, hi) in rangos) {
            repeat(15) {
                val env = vars.associateWith { lo + rnd.nextDouble() * (hi - lo) }
                val va = try { Parser(ta, env).evaluar() } catch (e: Exception) { return false }
                val vb = try { Parser(tb, env).evaluar() } catch (e: Exception) { return false }
                if (va.isFinite() && vb.isFinite() && abs(va) < 1e6 && abs(vb) < 1e6) {
                    difs.add(va - vb)
                    escala = max(escala, abs(vb))
                }
            }
        }
        if (difs.size < 6) return false
        val dispersion = (difs.max() - difs.min())
        return dispersion <= 1e-6 * max(1.0, escala)
    }

    // ---------- LaTeX -> expresión plana ----------

    private fun prepara(entrada: String): String {
        var s = entrada
            .replace(" ", "").replace("·", "").lowercase()
            .replace("\\left", "").replace("\\right", "")
            .replace("\\cdot", "*").replace("\\,", "")
            .replace("sen", "sin")
            .replace("\\", "")

        // frac{A}{B} -> ((A)/(B))
        while (true) {
            val i = s.indexOf("frac{")
            if (i < 0) break
            val (numerador, j) = grupo(s, i + 4)
            require(j < s.length && s[j] == '{') { "frac sin denominador" }
            val (denominador, k) = grupo(s, j)
            s = s.substring(0, i) + "((" + numerador + ")/(" + denominador + "))" + s.substring(k)
        }
        // sqrt[n]{A} -> ((A)^(1/n))   (raíz n-ésima, ej. \sqrt[3]{x^2})
        while (true) {
            val i = s.indexOf("sqrt[")
            if (i < 0) break
            val cierre = s.indexOf(']', i + 5)
            require(cierre > 0) { "raíz sin ] de cierre" }
            val indiceRaiz = s.substring(i + 5, cierre)
            require(cierre + 1 < s.length && s[cierre + 1] == '{') { "raíz sin {" }
            val (radicando, j) = grupo(s, cierre + 1)
            s = s.substring(0, i) + "((" + radicando + ")^(1/" + indiceRaiz + "))" + s.substring(j)
        }
        // sqrt{A} -> sqrt(A)
        while (true) {
            val i = s.indexOf("sqrt{")
            if (i < 0) break
            val (radicando, j) = grupo(s, i + 4)
            s = s.substring(0, i) + "sqrt(" + radicando + ")" + s.substring(j)
        }
        // llaves restantes -> paréntesis
        s = s.map { c -> if (c == '{') '(' else if (c == '}') ')' else c }.joinToString("")
        // |A| -> abs(A)
        val sb = StringBuilder()
        var barraAbierta = false
        for (c in s) {
            if (c == '|') {
                sb.append(if (!barraAbierta) "abs(" else ")")
                barraAbierta = !barraAbierta
            } else sb.append(c)
        }
        require(!barraAbierta) { "barra | sin cerrar" }
        return sb.toString()
    }

    /** Devuelve (contenido, índice tras la llave de cierre). s[inicio] debe ser '{'. */
    private fun grupo(s: String, inicio: Int): Pair<String, Int> {
        require(inicio < s.length && s[inicio] == '{')
        var nivel = 0
        for (i in inicio until s.length) {
            if (s[i] == '{') nivel++
            if (s[i] == '}') {
                nivel--
                if (nivel == 0) return s.substring(inicio + 1, i) to (i + 1)
            }
        }
        throw IllegalArgumentException("llave sin cerrar")
    }

    // ---------- tokens ----------

    private fun tokens(s: String): List<String> {
        val out = mutableListOf<String>()
        var i = 0
        while (i < s.length) {
            val c = s[i]
            when {
                c.isDigit() || c == '.' -> {
                    val j = i
                    while (i < s.length && (s[i].isDigit() || s[i] == '.')) i++
                    out.add(s.substring(j, i))
                }
                c.isLetter() -> {
                    val f = FUNCIONES.firstOrNull { s.startsWith(it, i) }
                    if (f != null) { out.add(f); i += f.length }
                    else { out.add(c.toString()); i++ }
                }
                c in "+-*/^()" -> { out.add(c.toString()); i++ }
                else -> throw IllegalArgumentException("símbolo no soportado: $c")
            }
        }
        return out
    }

    private fun esOperando(t: String): Boolean =
        t == ")" || t.toDoubleOrNull() != null || (t.length == 1 && t[0].isLetter())

    private fun iniciaOperando(t: String): Boolean =
        t == "(" || t.toDoubleOrNull() != null || (t.length == 1 && t[0].isLetter()) || t in FUNCIONES

    /** Inserta la multiplicación implícita: 3x -> 3*x, u^4x -> u^4*x, 2(x) -> 2*(x)… */
    private fun conMultImplicita(ts: List<String>): List<String> {
        val out = mutableListOf<String>()
        for (t in ts) {
            if (out.isNotEmpty() && esOperando(out.last()) && iniciaOperando(t)) out.add("*")
            out.add(t)
        }
        return out
    }

    private fun variables(ts: List<String>): Set<String> =
        ts.filter { it.length == 1 && it[0].isLetter() && it != "e" }.toSet()

    // ---------- parser / evaluador ----------

    private class Parser(val ts: List<String>, val env: Map<String, Double>) {
        var p = 0

        fun evaluar(): Double {
            val v = expr()
            require(p == ts.size) { "sobran tokens" }
            return v
        }

        fun ver(): String? = if (p < ts.size) ts[p] else null
        fun tomar(): String = ts[p++]

        fun expr(): Double {
            var v = when (ver()) {
                "-" -> { tomar(); -term() }
                "+" -> { tomar(); term() }
                else -> term()
            }
            while (ver() == "+" || ver() == "-") {
                val op = tomar()
                val t = term()
                v = if (op == "+") v + t else v - t
            }
            return v
        }

        fun term(): Double {
            var v = factor()
            while (ver() == "*" || ver() == "/") {
                val op = tomar()
                val f = factor()
                v = if (op == "*") v * f else v / f
            }
            return v
        }

        // potencia asociativa a la derecha: x^2^3 = x^(2^3)
        fun factor(): Double {
            val b = base()
            if (ver() == "^") {
                tomar()
                val e = if (ver() == "-") { tomar(); -factor() } else factor()
                return b.pow(e)
            }
            return b
        }

        fun base(): Double {
            val t = tomar()
            return when {
                t == "(" -> { val v = expr(); require(tomar() == ")"); v }
                t == "-" -> -factor()
                t.toDoubleOrNull() != null -> t.toDouble()
                t in FUNCIONES -> {
                    // acepta sin(x) y también sinx / ln|x| (sin paréntesis)
                    val arg = if (ver() == "(") {
                        tomar(); val v = expr(); require(tomar() == ")"); v
                    } else factor()
                    aplicar(t, arg)
                }
                t.length == 1 && t[0].isLetter() ->
                    if (t == "e") Math.E else env[t] ?: throw IllegalArgumentException("variable $t")
                else -> throw IllegalArgumentException("token $t")
            }
        }

        fun aplicar(f: String, x: Double): Double = when (f) {
            "sin" -> sin(x)
            "cos" -> cos(x)
            "tan" -> tan(x)
            "sec" -> 1.0 / cos(x)
            "csc" -> 1.0 / sin(x)
            "cot" -> cos(x) / sin(x)
            "ln" -> ln(x)
            "sqrt" -> sqrt(x)
            "abs" -> abs(x)
            else -> throw IllegalArgumentException(f)
        }
    }
}
