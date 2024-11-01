<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://sortter.fi
 * @since      1.1.0
 *
 * @package    Sortter_Laskuri
 * @subpackage Sortter_Laskuri/public/partials
 */


$sortterDataAtts = array();
$sortterDataAtts["data-sortter-partner"] = get_option('sortter-laskuri_seller_code');
$sortterDataAtts["data-sortter-initial-period"] = get_option('sortter-laskuri_default_time');
$sortterDataAtts["data-sortter-initial-amount"] = get_option('sortter-laskuri_default_sum');

function sortter_translate3DString($value = 1, $maxval = 1)
{
    $sortter_3dval_1 =  ($value / $maxval * 100) - 101.5;
    $sortter_3dval_string = 'translate3d(' . $sortter_3dval_1 . '%, 0px, 0px)';
    return $sortter_3dval_string;
}

$initialSumProgress = sortter_translate3DString($sortterDataAtts["data-sortter-initial-amount"], 60000);
$initialTimeProgress = sortter_translate3DString($sortterDataAtts["data-sortter-initial-period"], 15);
// https://sortter.fi?utm_source=https&utm_medium=partners&utm_campaign=rahoituslaskuri&utm_term=code
$initialSubmitUrl = sprintf('
    https://sortter.fi/lainahakemus/?%s&amount=%d&period=%d', 
    $sortter_utm_query,
    $sortterDataAtts["data-sortter-initial-amount"], 
    $sortterDataAtts["data-sortter-initial-period"]
);

?>

<aside id="sortter-dialog-container" class="container-module--large--6239f calculator-module--container--uH8E6">
    <div class="calculator-module--calculator--md+db">
        <div id="landing-calculator-unsecured" data-calculator="" class="widget-calculator-module--widget-calculator--SMEDZ">
            <h1 id="sortter-brand">Sortter</h1>
            <p class="">Vertaile lainatarjouksia helposti</p>
            <div data-slider-with-input="" class="slider-with-input-module--container--aDFzP">
                <div class="slider-with-input-module--headline--04Ybd">
                    <div class="slider-with-input-module--title-container--6D3Um">
                        <h3 class="title-module--base--jFNbR title-module--heading4--TXOyA title-module--bold--Iqu8E slider-with-input-module--slider-label--Jk0Q8">Valitse lainasumma</h3>
                    </div>
                    <div class="slider-with-input-module--slider-value-container--1xDRt">
                        <div id="landing-calculator-loan-amount-slider-input-edit" style="display: block;" class="slider-with-input-module--slider-value--HcRNw slider-with-input-module--static-slider-value--jt60U">
                            <span><?php echo esc_html($sortterDataAtts["data-sortter-initial-amount"]); ?></span> €
                        </div>
                        <?php
                        /**
                         * Following input is for manual (input[type=number] possibility). 
                         * It is not necesseary to implement now but might become relevant in the future.  
                         * <input type="number" id="landing-calculator-loan-amount-slider-input" style="display: none;" step="100" min="1000" max="60000" value="<?php echo esc_html($sortterDataAtts["data-sortter-initial-amount"]); ?>" class="slider-with-input-module--slider-value--HcRNw slider-with-input-module--editable-slider-value--KffuN">
                         */
                        ?>
                    </div>
                </div>
                <label class="slider-module--container--9l7my">
                    <div class="slider-module--progress-container--dCZ6w">
                        <div id="landing-calculator-loan-amount-progress" class="slider-module--progress---xdJn" style="transform: <?php echo esc_attr($initialSumProgress); ?>;"></div>
                    </div>
                    <input data-param="amount" type="range" min="1000" max="60000" data-default="<?php echo $sortterDataAtts["data-sortter-initial-amount"]; ?>" value="<?php echo $sortterDataAtts["data-sortter-initial-amount"]; ?>" aria-valuemin="1000" aria-valuemax="60000" aria-valuenow="<?php echo esc_attr($sortterDataAtts["data-sortter-initial-amount"]); ?>" step="500" id="landing-calculator-loan-amount-slider" class="slider-module--slider--UBNwU">
                </label>
            </div>
            <div data-slider-with-input="" class="slider-with-input-module--container--aDFzP">
                <div class="slider-with-input-module--headline--04Ybd">
                    <div class="slider-with-input-module--title-container--6D3Um">
                        <h3 class="title-module--base--jFNbR title-module--heading4--TXOyA title-module--bold--Iqu8E slider-with-input-module--slider-label--Jk0Q8">Valitse laina-aika</h3>
                    </div>
                    <div class="slider-with-input-module--slider-value-container--1xDRt">
                        <div id="landing-calculator-loan-period-slider-input-edit" style="display: block;" class="slider-with-input-module--slider-value--HcRNw slider-with-input-module--static-slider-value--jt60U">
                            <span><?php echo esc_html($sortterDataAtts["data-sortter-initial-period"]); ?></span>
                            <?php _e('vuotta', 'sortter-rahoituslaskuri'); ?>
                        </div>
                        <?php
                        /**
                         * Following input is for manual (input[type=number] possibility). 
                         * It is not necesseary to implement now but might become relevant in the future.  
                         * <input type="number" id="landing-calculator-loan-period-slider-input" style="display: none;" step="1" min="1" max="15" value="<?php echo esc_html($sortterDataAtts["data-sortter-initial-period"]); ?>" class="slider-with-input-module--slider-value--HcRNw slider-with-input-module--editable-slider-value--KffuN">
                         */
                        ?>
                    </div>
                </div>
                <label class="slider-module--container--9l7my">
                    <div class="slider-module--progress-container--dCZ6w">
                        <div id="landing-calculator-loan-period-progress" class="slider-module--progress---xdJn" style="transform: <?php echo esc_attr($initialTimeProgress); ?>;"></div>
                    </div>
                    <input data-param="period" type="range" min="1" max="15" data-default="<?php echo esc_attr($sortterDataAtts["data-sortter-initial-period"]); ?>" value="<?php echo esc_attr($sortterDataAtts["data-sortter-initial-period"]); ?>" aria-valuemin="1" aria-valuemax="15" aria-valuenow="<?php echo esc_attr($sortterDataAtts["data-sortter-initial-period"]); ?>" step="1" id="landing-calculator-loan-period-slider" class="slider-module--slider--UBNwU">
                </label>
            </div>
            <div class="widget-calculator-module--cta-section--AeoTf">
                <div id="landing-calculator-calculation" class="widget-calculator-module--calculation--FC305"><span>-</span>&nbsp;€<div class="widget-calculator-module--tooltip-and-label--CqZur">
                        <div class="text-module--base--AjetI text-module--large--bgJwG text-module--normal-font--zx+s2 widget-calculator-module--calculation-text--nSd-O">Arvioitu kuukausierä</div>
                    </div>
                </div>
                <div class="button-module--full-width--6eNEr widget-calculator-module--cta-btn--pV9f+">
                    <a id="landing-calculator-button-onboarding" data-param-amount="<?php echo esc_attr($sortterDataAtts["data-sortter-initial-amount"]); ?>" data-param-period="<?php echo esc_attr($sortterDataAtts["data-sortter-initial-period"]); ?>" data-sortter-submit-url="<?php echo esc_url($initialSubmitUrl); ?>" href="<?php echo esc_url($initialSubmitUrl); ?>" style="--button-color: var(--color-cta-2); --button-shadow-color: var(--color-cta-2-rgb);" class="button-module--button--1E5vB button-module--primary--vbOtN" data-wct-parsed="1">Lähetä hakemus<span style="margin-left: 12px;">»</span></a>
                </div>
            </div>
            <div data-disclaimer="" class="widget-calculator-module--disclaimer--QfGbo">
                Laina-aika voi olla 1-15 vuotta, lainasumma 1 000–60 000 € ja korko 4–20 %. Esimerkki: Kun lainasumma on 14&nbsp;000&nbsp;€, korko 6&nbsp;%, takaisinmaksuaika 8 vuotta, avausmaksu 0 € ja tilinhoitomaksu 5 €/kk, kuukausierä on 189&nbsp;€, takaisinmaksettava summa 18&nbsp;142&nbsp;€ sekä todellinen vuosikorko on 6,94&nbsp;%.
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var sortterInputs = [
            document.getElementById("landing-calculator-loan-amount-slider"),
            document.getElementById("landing-calculator-loan-period-slider")
        ];
        for (let inputI = 0; inputI < sortterInputs.length; inputI++) {
            try {
                sortterInputs[inputI].value = sortterInputs[inputI].dataset.default;
            } catch (error) {
                console.warning('could not set initial values to sortter inputs.', error);
            }
        }
    </script>
</aside>