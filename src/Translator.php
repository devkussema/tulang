<?php

class Translator
{
    /**
     * Realiza a raspagem do conteúdo da página web do Google Translate para traduzir o texto especificado para o idioma desejado.
     *
     * @param string $texto O texto a ser traduzido.
     * @param string $lang O idioma de destino para a tradução (por exemplo, "en" para inglês).
     * @return string A tradução do texto especificado para o idioma desejado.
     */
    public function translate($texto, $lang)
    {
        // Idioma de destino
        $idioma_destino = $lang; // Por exemplo, "en" para inglês

        // URL da API do Google Translate
        $url = "https://translate.google.com/m?sl=auto&tl=$idioma_destino&ie=UTF-8&prev=_m&q=" . urlencode($texto);

        // Faz a requisição HTTP GET
        $traducao_html = file_get_contents($url);

        // Analisa o HTML para extrair a tradução
        $padrao = '/<div class="result-container">(.*?)<\/div>/s';
        preg_match($padrao, $traducao_html, $traducao);

        // var_dump($traducao_html);
        if (isset($traducao[1])) {
            // Imprime a tradução
            return htmlspecialchars_decode($traducao[1]);
        } else {
            return "Erro ao traduzir o texto.";
        }
    }
}