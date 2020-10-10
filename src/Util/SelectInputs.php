<?php
namespace Util\HTML;

/**
 * Class SelectInputs
 * @package Util\HTML
 *
 * Creates SelectInputs and adds them to the page
 * Note by Robert: Feel free to improve on, using a bunch of echo commands seems wrong but I had to get it done fast.
 * TODO: Update days based on month selected, or do validation at the very least.
 *
 * Inspired by: https://css-tricks.com/striking-a-balance-between-native-and-custom-select-elements/
 */
class SelectInputs {

    

    //Create a dropdown with number values (specify start, end, label of the dropdown & ID for Aria)
    public static function numberInput($start, $end, $label, $id){
        echo '<div class="form__cell">';
            echo '<label id="'.$id.'_Label" class="input__label input__label--small" for="'.$id.'">'.$label.'</label><br>';
            echo '<div class="select">';
                echo '<div class="selectWrapper">';
                    echo '<select id="'.$id.'" name="'.$id.'" class="selectNative js-selectNative" aria-labelledby="'.$id.'_Label" required>';
                        echo '<option value="sel" disabled="" selected="selected">'.$label.'</span>';
                        for ($x = $start; $x <= $end; $x++) {
                            echo '<option value="'.$x.'">'.$x.'</option>'."\n";
                        }
                    echo '</select>';
                    echo '<div class="selectCustom js-selectCustom" aria-hidden="true">';
                        echo '<div class="selectCustom-trigger" data-value="'.$label.'">'.$label.'</div>';
                            echo '<div class="selectCustom-options">';
                            for ($x = $start; $x <= $end; $x++) {
                                echo '<div class="selectCustom-option" data-value="'.$x.'">'.$x.'</div>'."\n";
                            }
        echo '</div></div></div></div></div>';
    }

    //Create a dropdown with month values
    public static function monthInput(){
        $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $label = "Month";
        $id = "birthday__month";
        $length = count($months);

        echo '<div class="form__cell">';
            echo '<label id="'.$id.'_Label" class="input__label input__label--small" for="'.$id.'">'.$label.'</label><br>';
            echo '<div class="select">';
                echo '<div class="selectWrapper">';
                    echo '<select id="'.$id.'" name="'.$id.'" class="selectNative js-selectNative" aria-labelledby="'.$id.'_Label" required>';
                        echo '<option value="sel" disabled="" selected="selected">'.$label.'</span>';
                        for ($x = 0; $x < $length; $x++) {
                            echo '<option value="'.$months[$x].'">'.$months[$x].'</option>'."\n";
                        }
                    echo '</select>';
                    echo '<div class="selectCustom js-selectCustom" aria-hidden="true">';
                        echo '<div class="selectCustom-trigger"  data-value="'.$label.'">'.$label.'</div>';
                            echo '<div class="selectCustom-options">';
                            for ($x = 0; $x < $length; $x++) {
                                echo '<div class="selectCustom-option" data-value="'.$months[$x].'">'.$months[$x].'</div>'."\n";
                            }
        echo '</div></div></div></div></div>';
    }
}