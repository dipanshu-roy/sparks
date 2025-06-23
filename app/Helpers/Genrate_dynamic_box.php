<?php

use App\Models\labsDetails;
use Illuminate\Support\Facades\Auth;

if (!function_exists('Genrate_dynamic_box')) {
    function Genrate_dynamic_box($labname)
    {
        $user = Auth::guard('school')->user();

        // Fetch labs matching the lab name and registration ID
        $labs = labsDetails::where('registration_id', $user->id)
                            ->where('labs_name', $labname)
                            ->get();

        $output = '<div class="lab-checkbox-grid">';
         
        foreach ($labs as $lab) {
            $output .= '<div class="checkbox-row">';
        
            for ($col = 1; $col <= $lab->computer_qty; $col++) {
                $id = "{$labname}-{$col}";
        
                $output .= '
                    <label class="checkbox-container">
                        <input type="checkbox" id="' . $id . '" onchange="toggleIcon(\'' . $id . '\')">
                        <span class="check-icon" id="icon-' . $id . '">' . $col . '</span>
                    </label>
                ';
        
                // Every 20 checkboxes, start a new row
                if ($col % 20 == 0 && $col != $lab->computer_qty) {
                    $output .= '</div><div class="checkbox-row">';
                }
            }
        
            $output .= '</div>'; // End final row
        }
        

        $output .= '</div>'; // End grid
        return $output;
    }
}

 