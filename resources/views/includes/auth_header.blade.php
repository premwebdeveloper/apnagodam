<?php
    use App\CaseGen;

    $currentuserid = Auth::user()->id;
    $role = DB::table('user_roles')->where('user_id', $currentuserid)->first();
    $emp_levels = DB::table('emp_levels')->where('user_id', $currentuserid)->first();
    $role_id = $role->role_id;

    $notifications = 0;
    $noti_link = '';

    $case_gen = CaseGen::getCasePrice();
    $n = 0;
    foreach($case_gen as $key => $pricing){
        $res = DB::table('apna_case_quality_report')->where('case_id', $pricing->case_id)->first();
        if(!$pricing->p_case_id){
            if($pricing->in_out == 'PASS'){
                if($role_id == 1 || $role_id == 8 || $role_id == 9){
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }elseif($pricing->in_out == 'IN'){
                if($role_id == 1 || $role_id == 8 || $role_id == 9){
                    $notifications++;
                    $n++;
                }
            }elseif($pricing->in_out == 'OUT'){
                if($role_id == 1 || $role_id == 8 || $role_id == 9){
                    $notifications++;
                    $n++;
                }
            }
        }
    }

    if($n > 0){
        if($n > 1){
            $case_spl = 'Cases';
        }else{
            $case_spl = 'Case';
        }
        $noti_link = '<li><a href="'.url('/pricing').'" class="dropdown-item"><div><span class="label label-danger">'.$n.'</span> &nbsp;&nbsp;&nbsp;&nbsp;<b>New '.$case_spl.' for Pricing </b></div></a></li><li class="dropdown-divider"></li>';
    }

    $case_gen = CaseGen::getCaseQualityReport();
    $n = 0;
    foreach($case_gen as $key => $case){        
        if(!$case->q_r_case_id){
            if($case->in_out == 'PASS'){
                if($role_id == 1 || $currentuserid == $case->lead_conv_uid || $role_id == 8){
                    $notifications++;
                    $n++;
                }
            }
            elseif($case->in_out == 'IN'){
                if($role_id == 1 || $role_id == 8 || ($role_id == 7 && $emp_levels->location == $case->terminal_id) || ($role_id == 7 && $emp_levels->level_id < 3)){
                    $res = DB::table('apna_case_kanta_parchi')->where('case_id', $case->case_id)->first();
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }elseif($case->in_out == 'OUT'){
                if($role_id == 1 || $role_id == 8 || ($role_id == 7 && $emp_levels->location == $case->terminal_id) || ($role_id == 7 && $emp_levels->level_id < 3)){
                    $res = DB::table('apna_labour_book')->where('case_id', $case->case_id)->first();
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }
        }
    }

    if($n > 0){
        if($n > 1){
            $case_spl = 'Cases';
        }else{
            $case_spl = 'Case';
        }
        $noti_link .= '<li><a href="'.url('/quality_report').'" class="dropdown-item"><div><span class="label label-danger">'.$n.'</span> &nbsp;&nbsp;&nbsp;&nbsp;<b>New '.$case_spl.' for First Quality Report </b></div></a></li><li class="dropdown-divider"></li>';
    }

    $case_gen = CaseGen::getCaseGatePass();
    $n = 0;
    foreach($case_gen as $key => $case){        
        if(!$case->g_p_case_id){
            if($case->in_out == 'PASS'){
                if($role_id == 1 || $role_id == 8 || ($role_id == 6 && $currentuserid == $case->lead_conv_uid)){
                    $res = DB::table('apna_case_second_kanta_parchi')->where('case_id', $case->case_id)->first();
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }elseif($case->in_out == 'IN'){
                if($role_id == 1 || $role_id == 8 || ($role_id == 7 && $emp_levels->location == $case->terminal_id) || ($role_id == 7 && $emp_levels->level_id < 3)){
                    $res = DB::table('apna_case_second_quality_report')->where('case_id', $case->case_id)->first();
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }
            elseif($case->in_out == 'OUT')
            {
                if($role_id == 1 || $role_id == 8 || ($role_id == 7 && $emp_levels->location == $case->terminal_id) || ($role_id == 7 && $emp_levels->level_id < 3))
                {
                    $res = DB::table('apna_case_second_quality_report')->where('case_id', $case->case_id)->first();
                    if($res)
                    {
                        $notifications++;
                        $n++;
                    }
                }
            }
        }
    }

    if($n > 0){
        if($n > 1){
            $case_spl = 'Cases';
        }else{
            $case_spl = 'Case';
        }
        $noti_link .= '<li><a href="'.url('/gate_pass').'" class="dropdown-item"><div><span class="label label-danger">'.$n.'</span> &nbsp;&nbsp;&nbsp;&nbsp;<b>New '.$case_spl.' for Gate Pass </b></div></a></li><li class="dropdown-divider"></li>';
    }

    $case_gen = CaseGen::getCaseKantaParchi();
    $n = 0;
    foreach($case_gen as $key => $case){        
        if(!$case->k_p_case_id)
        {
            $res = DB::table('apna_labour_book')->where('case_id', $case->case_id)->first();
            if($case->in_out == 'PASS'){
                if($role_id == 1 || $role_id == 8 || $role_id == 6){
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }elseif($case->in_out == 'IN'){
                if($role_id == 1 || $role_id == 8 || ($role_id == 7 && $emp_levels->location == $case->terminal_id) || ($role_id == 7 && $emp_levels->level_id < 3)){
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }elseif($case->in_out == 'OUT'){
                if($role_id == 1 || $role_id == 8 || ($role_id == 7 && $emp_levels->location == $case->terminal_id) || ($role_id == 7 && $emp_levels->level_id < 3)){
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }
        }
    }

    if($n > 0){
        if($n > 1){
            $case_spl = 'Cases';
        }else{
            $case_spl = 'Case';
        }
        $noti_link .= '<li><a href="'.url('/kanta_parchi').'" class="dropdown-item"><div><span class="label label-danger">'.$n.'</span> &nbsp;&nbsp;&nbsp;&nbsp;<b>New '.$case_spl.' for First Kanta Parchi </b></div></a></li><li class="dropdown-divider"></li>';
    }

    $case_gen = CaseGen::getCaseTruckBook();
    $n = 0;
    foreach($case_gen as $key => $case){
        if(!$case->t_b_case_id){
            if($case->in_out == 'PASS'){
                if($role_id == 1 || $role_id == 8 || $role_id == 6){
                    $res = DB::table('apna_case_pricing')->where('case_id', $case->case_id)->first();
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }elseif($case->in_out == 'IN'){
                if($role_id == 1 || $role_id == 8 || $role_id == 11){
                    $res = DB::table('apna_case_delivery_order')->where('case_id', $case->case_id)->first();
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }elseif($case->in_out == 'OUT'){
                if($role_id == 1 || $role_id == 8 || $role_id == 11){
                    $res = DB::table('apna_case_pricing')->where('case_id', $case->case_id)->first();
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }
        }
    }

    if($n > 0){
        if($n > 1){
            $case_spl = 'Cases';
        }else{
            $case_spl = 'Case';
        }
        $noti_link .= '<li><a href="'.url('/truck_book').'" class="dropdown-item"><div><span class="label label-danger">'.$n.'</span> &nbsp;&nbsp;&nbsp;&nbsp;<b>New '.$case_spl.' for Truck Book </b></div></a></li><li class="dropdown-divider"></li>';
    }

    $case_gen = CaseGen::getCaseLabourBook();
    $n = 0;
    foreach($case_gen as $key => $case){        
        if(!$case->l_b_case_id){
            $res = DB::table('apna_truck_book')->where('case_id', $case->case_id)->first();
            if($case->in_out == 'PASS'){
                if($role_id == 1 || $role_id == 8 || $role_id == 6){
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }elseif($case->in_out == 'IN'){
                if($role_id == 1 || $role_id == 8 || $role_id == 11){
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }elseif($case->in_out == 'OUT'){
                if($role_id == 1 || $role_id == 8 || $role_id == 11){
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }
        }
    }

    if($n > 0){
        if($n > 1){
            $case_spl = 'Cases';
        }else{
            $case_spl = 'Case';
        }
        $noti_link .= '<li><a href="'.url('/labour_book').'" class="dropdown-item"><div><span class="label label-danger">'.$n.'</span> &nbsp;&nbsp;&nbsp;&nbsp;<b>New '.$case_spl.' for Labour Book </b></div></a></li><li class="dropdown-divider"></li>';
    }

    $case_gen = CaseGen::getCaseSecondQualityReport();
    $n = 0;
    foreach($case_gen as $key => $case){        
        if(!$case->s_q_r_case_id){
            if($case->in_out == 'PASS'){
                if($role_id == 1 || $currentuserid == $case->lead_conv_uid || ($role_id == 8 && $emp_levels->location == $case->terminal_id) || ($role_id == 8 && $emp_levels->level_id < 3)){
                    $res = DB::table('apna_case_kanta_parchi')->where('case_id', $case->case_id)->first();
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }elseif($case->in_out == 'IN'){
                if($role_id == 1 || $role_id == 8 || ($role_id == 7 && $emp_levels->location == $case->terminal_id) || ($role_id == 7 && $emp_levels->level_id < 3)){
                    $res = DB::table('apna_case_second_kanta_parchi')->where('case_id', $case->case_id)->first();
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }elseif($case->in_out == 'OUT'){
                if($role_id == 1 || $role_id == 8 || ($role_id == 7 && $emp_levels->location == $case->terminal_id) || ($role_id == 7 && $emp_levels->level_id < 3)){
                    $res = DB::table('apna_case_kanta_parchi')->where('case_id', $case->case_id)->first();
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }
        }
    }

    if($n > 0){
        if($n > 1){
            $case_spl = 'Cases';
        }else{
            $case_spl = 'Case';
        }
        $noti_link .= '<li><a href="'.url('/second_quality_report').'" class="dropdown-item"><div><span class="label label-danger">'.$n.'</span> &nbsp;&nbsp;&nbsp;&nbsp;<b>New '.$case_spl.' for Second Quality Report </b></div></a></li><li class="dropdown-divider"></li>';
    }

    $case_gen = CaseGen::getCaseSecondKantaParchi();
    $n = 0;
    foreach($case_gen as $key => $case){        
        if(!$case->s_k_p_case_id){
            if($case->in_out == 'PASS'){
                if($role_id == 1 || $currentuserid == $case->lead_conv_uid || $role_id == 8){
                    $res = DB::table('apna_case_second_quality_report')->where('case_id', $case->case_id)->first();
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }elseif($case->in_out == 'IN'){
                if($role_id == 1 || $role_id == 8 || ($role_id == 7 && $emp_levels->location == $case->terminal_id) || ($role_id == 7 && $emp_levels->level_id < 3)){
                    $res = DB::table('apna_case_quality_report')->where('case_id', $case->case_id)->first();
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }elseif($case->in_out == 'OUT'){
                if($role_id == 1 || $role_id == 8 || ($role_id == 7 && $emp_levels->location == $case->terminal_id) || ($role_id == 7 && $emp_levels->level_id < 3)){
                    $res = DB::table('apna_case_quality_report')->where('case_id', $case->case_id)->first();
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }
        }
    }

    if($n > 0){
        if($n > 1){
            $case_spl = 'Cases';
        }else{
            $case_spl = 'Case';
        }
        $noti_link .= '<li><a href="'.url('/second_kanta_parchi').'" class="dropdown-item"><div><span class="label label-danger">'.$n.'</span> &nbsp;&nbsp;&nbsp;&nbsp;<b>New '.$case_spl.' for Second Kanta Parchi </b></div></a></li><li class="dropdown-divider"></li>';
    }

    $case_gen = CaseGen::getCaseEMandi();
    $n = 0;
    foreach($case_gen as $key => $case){        
        if(!$case->file){
            $res = DB::table('apna_case_gate_pass')->where('case_id', $case->case_id)->first();
            $check_pricing = DB::table('apna_case_pricing')->where('case_id', $case->case_id)->first();
            if($case->in_out == 'PASS'){
                if($role_id == 1 || $role_id == 13 || $role_id == 8){
                    if($res && $check_pricing->transaction_type == 'E-Mandi'){
                        $notifications++;
                        $n++;
                    }
                }
            }elseif($case->in_out == 'OUT'){
                if($role_id == 1 || $role_id == 13){
                    $res = DB::table('apna_case_quality_report')->where('case_id', $case->case_id)->first();
                    if($res && $check_pricing->transaction_type == 'E-Mandi'){
                        $notifications++;
                        $n++;
                    }
                }
            }
        }
    }

    if($n > 0){
        if($n > 1){
            $case_spl = 'Cases';
        }else{
            $case_spl = 'Case';
        }
        $noti_link .= '<li><a href="'.url('/e_mandi').'" class="dropdown-item"><div><span class="label label-danger">'.$n.'</span> &nbsp;&nbsp;&nbsp;&nbsp;<b>New '.$case_spl.' for E-Mandi </b></div></a></li><li class="dropdown-divider"></li>';
    }

    $case_gen = CaseGen::getCaseAccounts();
    $n = 0;
    foreach($case_gen as $key => $case){        
        if(!$case->a_case_id){
            $res = DB::table('apna_case_e_mandi')->where('case_id', $case->case_id)->first();
            $check_pricing = DB::table('apna_case_pricing')->where('case_id', $case->case_id)->first();
            if($case->in_out == 'PASS'){
                if($role_id == 1 || $role_id == 3 || $role_id == 8){
                    if($res && $check_pricing->transaction_type == 'E-Mandi'){
                        $notifications++;
                        $n++;
                    }else{
                        $res = DB::table('apna_case_gate_pass')->where('case_id', $accounts->case_id)->first();
                        if($res){
                            $notifications++;
                            $n++;
                        }
                    }
                }
            }elseif($case->in_out == 'IN'){
                if($role_id == 1 || $role_id == 3 || $role_id == 8){
                    $res = DB::table('apna_case_cdf')->where('case_id', $case->case_id)->first();
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }elseif($case->in_out == 'OUT'){
                if($role_id == 1 || $role_id == 13){
                    $res = DB::table('apna_case_quality_report')->where('case_id', $case->case_id)->first();
                    if($res && $check_pricing->transaction_type == 'E-Mandi'){
                        $notifications++;
                        $n++;
                    }
                }
            }
        }
    }

    if($n > 0){
        if($n > 1){
            $case_spl = 'Cases';
        }else{
            $case_spl = 'Case';
        }
        $noti_link .= '<li><a href="'.url('/accounts').'" class="dropdown-item"><div><span class="label label-danger">'.$n.'</span> &nbsp;&nbsp;&nbsp;&nbsp;<b>New '.$case_spl.' for Accounts </b></div></a></li><li class="dropdown-divider"></li>';
    }

    $case_gen = CaseGen::getIvrTagging();
    $n = 0;
    foreach($case_gen as $key => $case){        
        if(!$case->i_t_case_id){
            if($case->in_out == 'PASS'){
                if($role_id == 1 || $role_id == 8){
                    $res = DB::table('apna_case_accounts')->where('case_id', $case->case_id)->first();
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }elseif($case->in_out == 'IN'){
                if($role_id == 1 || $role_id == 8){
                    $res = DB::table('apna_case_accounts')->where('case_id', $case->case_id)->first();
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }elseif($case->in_out == 'OUT'){
                if($role_id == 1 || $role_id == 8){
                    $res = DB::table('apna_case_accounts')->where('case_id', $case->case_id)->first();
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }
        }
    }

    if($n > 0){
        if($n > 1){
            $case_spl = 'Cases';
        }else{
            $case_spl = 'Case';
        }
        $noti_link .= '<li><a href="'.url('/ivr_tagging').'" class="dropdown-item"><div><span class="label label-danger">'.$n.'</span> &nbsp;&nbsp;&nbsp;&nbsp;<b>New '.$case_spl.' for IVR Tagging </b></div></a></li><li class="dropdown-divider"></li>';
    }

    $case_gen = CaseGen::getCaseShippingStart();
    $n = 0;
    foreach($case_gen as $key => $case){        
        if(!$case->s_s_case_id){
            if($case->in_out == 'PASS'){
                if($role_id == 1 || $currentuserid == $case->lead_conv_uid || $role_id == 8){
                    $res = DB::table('apna_case_ivr_tagging')->where('case_id', $case->case_id)->first();
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }elseif($case->in_out == 'OUT'){
                if($role_id == 1 || $role_id == 11){
                    $res = DB::table('apna_case_ivr_tagging')->where('case_id', $case->case_id)->first();
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }
        }
    }

    if($n > 0){
        if($n > 1){
            $case_spl = 'Cases';
        }else{
            $case_spl = 'Case';
        }
        $noti_link .= '<li><a href="'.url('/shipping_start').'" class="dropdown-item"><div><span class="label label-danger">'.$n.'</span> &nbsp;&nbsp;&nbsp;&nbsp;<b>New '.$case_spl.' for Shipping Start </b></div></a></li><li class="dropdown-divider"></li>';
    }

    $case_gen = CaseGen::getCaseShippingEnd();
    $n = 0;
    foreach($case_gen as $key => $case){        
        if(!$case->s_e_case_id){
            $res = DB::table('apna_case_shipping_start')->where('case_id', $case->case_id)->first();
            if($case->in_out == 'PASS'){
                if($role_id == 1 || $currentuserid == $case->lead_conv_uid || $role_id == 8){
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }elseif($case->in_out == 'OUT'){
                if($role_id == 1 || $role_id == 11){
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }
        }
    }

    if($n > 0){
        if($n > 1){
            $case_spl = 'Cases';
        }else{
            $case_spl = 'Case';
        }
        $noti_link .= '<li><a href="'.url('/shipping_end').'" class="dropdown-item"><div><span class="label label-danger">'.$n.'</span> &nbsp;&nbsp;&nbsp;&nbsp;<b>New '.$case_spl.' for Shipping End </b></div></a></li><li class="dropdown-divider"></li>';
    }

    $case_gen = CaseGen::getCaseQualityClaim();
    $n = 0;
    foreach($case_gen as $key => $case){        
        if(!$case->q_c_case_id){
            if($case->in_out == 'PASS'){
                if($role_id == 1 || $role_id == 8 || $role_id == 9){
                    $res = DB::table('apna_case_shipping_end')->where('case_id', $case->case_id)->first();
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }elseif($case->in_out == 'IN'){
                if($role_id == 1 || $role_id == 8 || $role_id == 9){
                    $check_pricing = DB::table('apna_case_pricing')->where('case_id', $case->case_id)->first();
                    if($check_pricing){
                        if($check_pricing->transaction_type == 'E-Mandi'){
                            $res = DB::table('apna_case_e_mandi')->where('case_id', $case->case_id)->first();
                            if($res){
                                $notifications++;
                                $n++;
                            }
                        }else{
                            $res = DB::table('apna_case_gate_pass')->where('case_id', $case->case_id)->first();
                            if($res){
                                $notifications++;
                                $n++;
                            }
                        }
                    }
                }
            }elseif($case->in_out == 'OUT'){
                if($role_id == 1 || $role_id == 8 || $role_id == 9){
                    $res = DB::table('apna_case_shipping_end')->where('case_id', $case->case_id)->first();
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }
        }
    }

    if($n > 0){
        if($n > 1){
            $case_spl = 'Cases';
        }else{
            $case_spl = 'Case';
        }
        $noti_link .= '<li><a href="'.url('/quality_claim').'" class="dropdown-item"><div><span class="label label-danger">'.$n.'</span> &nbsp;&nbsp;&nbsp;&nbsp;<b>New '.$case_spl.' for Quality Claim </b></div></a></li><li class="dropdown-divider"></li>';
    }

    $case_gen = CaseGen::getCaseTruckPayment();
    $n = 0;
    foreach($case_gen as $key => $case){        
        if(!$case->t_p_case_id){
            if($case->in_out == 'PASS'){
                if($role_id == 1 || $role_id == 3 || $role_id == 8){
                    $res = DB::table('apna_case_quality_claim')->where('case_id', $case->case_id)->first();
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }elseif($case->in_out == 'IN'){
                if($role_id == 1 || $role_id == 8 || $role_id == 3){
                    $res = DB::table('apna_case_ivr_tagging')->where('case_id', $case->case_id)->first();
                    if($res)
                    {
                        $notifications++;
                        $n++;
                    }
                }
            }
            elseif($case->in_out == 'OUT')
            {
                if($role_id == 1 || $role_id == 3 || $role_id == 8)
                {
                    $res = DB::table('apna_case_quality_claim')->where('case_id', $case->case_id)->first();
                    if($res)
                    {
                        $notifications++;
                        $n++;
                    }
                }
            }
        }
    }

    if($n > 0){
        if($n > 1){
            $case_spl = 'Cases';
        }else{
            $case_spl = 'Case';
        }
        $noti_link .= '<li><a href="'.url('/truck_payment').'" class="dropdown-item"><div><span class="label label-danger">'.$n.'</span> &nbsp;&nbsp;&nbsp;&nbsp;<b>New '.$case_spl.' for Truck Payment  </b></div></a></li><li class="dropdown-divider"></li>';
    }


    $case_gen = CaseGen::getCaseLabourPayment();
    $n = 0;
    foreach($case_gen as $key => $case){        
        if(!$case->l_p_case_id){
            $res = DB::table('apna_case_truck_payment')->where('case_id', $case->case_id)->first();
            if($case->in_out == 'PASS'){
                if($role_id == 1 || $role_id == 3 || $role_id == 8){
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }elseif($case->in_out == 'IN'){
                if($role_id == 1 || $role_id == 8 || $role_id == 3){
                    if($res){
                        $notifications++;
                        $n++;
                    }                   
                }
            }elseif($case->in_out == 'OUT'){
                if($role_id == 1 || $role_id == 3 || $role_id == 8){
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }
        }
    }

    if($n > 0){
        if($n > 1){
            $case_spl = 'Cases';
        }else{
            $case_spl = 'Case';
        }
        $noti_link .= '<li><a href="'.url('/labour_payment').'" class="dropdown-item"><div><span class="label label-danger">'.$n.'</span> &nbsp;&nbsp;&nbsp;&nbsp;<b>New '.$case_spl.' for Labour Payment  </b></div></a></li><li class="dropdown-divider"></li>';
    }

    $case_gen = CaseGen::getCaseCCTV();
    $n = 0;
    foreach($case_gen as $key => $case){        
        if(!$case->cctv_case_id){
            if($case->in_out == 'IN'){
                if($role_id == 1 || $role_id == 14 || $role_id == 8){
                    $res = DB::table('apna_case_quality_claim')->where('case_id', $case->case_id)->first();
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }elseif($case->in_out == 'OUT'){
                if($role_id == 1 || $role_id == 14 || $role_id == 8){
                    if($case->transaction_type == 'E-Mandi'){
                        $res = DB::table('apna_case_e_mandi')->where('case_id', $case->case_id)->first();
                    }else{
                        $res = DB::table('apna_case_gate_pass')->where('case_id', $case->case_id)->first();
                    }if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }
        }
    }

    if($n > 0){
        if($n > 1){
            $case_spl = 'Cases';
        }else{
            $case_spl = 'Case';
        }
        $noti_link .= '<li><a href="'.url('/cctv').'" class="dropdown-item"><div><span class="label label-danger">'.$n.'</span> &nbsp;&nbsp;&nbsp;&nbsp;<b>New '.$case_spl.' for CCTV  </b></div></a></li><li class="dropdown-divider"></li>';
    }

    $case_gen = CaseGen::getCommodityDeposit();
    $n = 0;
    foreach($case_gen as $key => $case){        
        if(!$case->cdf_case_id){
            if($case->in_out == 'IN'){
                if($role_id == 1 || $role_id == 8 || ($role_id == 7 && $emp_levels->location == $case->terminal_id) || ($role_id == 7 && $emp_levels->level_id < 3)){
                    $res = DB::table('apna_case_cctv')->where('case_id', $case->case_id)->first();
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }            
        }
    }

    if($n > 0){
        if($n > 1){
            $case_spl = 'Cases';
        }else{
            $case_spl = 'Case';
        }
        $noti_link .= '<li><a href="'.url('/commodity_deposit').'" class="dropdown-item"><div><span class="label label-danger">'.$n.'</span> &nbsp;&nbsp;&nbsp;&nbsp;<b>New '.$case_spl.' for Commodity Deposit  </b></div></a></li><li class="dropdown-divider"></li>';
    }

    $case_gen = CaseGen::getWarehouseReceipt();
    $n = 0;
    foreach($case_gen as $key => $case){        
        if(!$case->w_r_case_id){
            if($case->in_out == 'IN'){
                if($role_id == 1 || $role_id == 3 || $role_id == 8){
                    $res = DB::table('apna_case_labour_payment')->where('case_id', $case->case_id)->first();
                    if($res){
                        $notifications++;
                        $n++;
                    }                   
                }
            }            
        }
    }

    if($n > 0){
        if($n > 1){
            $case_spl = 'Cases';
        }else{
            $case_spl = 'Case';
        }
        $noti_link .= '<li><a href="'.url('/warehouse_receipt').'" class="dropdown-item"><div><span class="label label-danger">'.$n.'</span> &nbsp;&nbsp;&nbsp;&nbsp;<b>New '.$case_spl.' for Warehouse Receipt  </b></div></a></li><li class="dropdown-divider"></li>';
    }

    $case_gen = CaseGen::getStorageReceipt();
    $n = 0;
    foreach($case_gen as $key => $case){
        if(!$case->s_r_case_id){
            if($case->in_out == 'IN'){
                if($role_id == 1 || $role_id == 3 || $role_id == 8){
                    $res = DB::table('apna_case_warehouse_receipt')->where('case_id', $case->case_id)->first();
                    if($res){
                        $notifications++;
                        $n++;
                    }                   
                }
            }            
        }
    }

    if($n > 0){
        if($n > 1){
            $case_spl = 'Cases';
        }else{
            $case_spl = 'Case';
        }
        $noti_link .= '<li><a href="'.url('/warehouse_receipt').'" class="dropdown-item"><div><span class="label label-danger">'.$n.'</span> &nbsp;&nbsp;&nbsp;&nbsp;<b>New '.$case_spl.' for Storage Receipt </b></div></a></li><li class="dropdown-divider"></li>';
    }

    $case_gen = CaseGen::getReleaseOrder();
    $n = 0;
    foreach($case_gen as $key => $case){
        if(!$case->r_o_case_id){
            if($case->in_out == 'OUT'){
                if($role_id == 1 || $role_id == 9 || $role_id == 8){
                    $res = DB::table('apna_case_pricing')->where('case_id', $case->case_id)->first();
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }
        }
    }

    if($n > 0){
        if($n > 1){
            $case_spl = 'Cases';
        }else{
            $case_spl = 'Case';
        }
        $noti_link .= '<li><a href="'.url('/release_order').'" class="dropdown-item"><div><span class="label label-danger">'.$n.'</span> &nbsp;&nbsp;&nbsp;&nbsp;<b>New '.$case_spl.' for Release Order </b></div></a></li><li class="dropdown-divider"></li>';
    }

    $case_gen = CaseGen::getDeliveryOrder();
    $n = 0;
    foreach($case_gen as $key => $case){
        if(!$case->d_o_case_id)
        {
            if($case->in_out == 'OUT')
            {
                if($role_id == 1 || $role_id == 9 || $role_id == 8)
                {
                    $res = DB::table('apna_case_release_order')->where('case_id', $case->case_id)->first();
                    if($res)
                    {
                        $notifications++;
                        $n++;
                    }            
                }
            }
        }
    }

    if($n > 0){
        if($n > 1){
            $case_spl = 'Cases';
        }else{
            $case_spl = 'Case';
        }
        $noti_link .= '<li><a href="'.url('/delivery_order').'" class="dropdown-item"><div><span class="label label-danger">'.$n.'</span> &nbsp;&nbsp;&nbsp;&nbsp;<b>New '.$case_spl.' for Delivery Order </b></div></a></li><li class="dropdown-divider"></li>';
    }

    $case_gen = CaseGen::getCommodityWithdrawal();
    $n = 0;
    foreach($case_gen as $key => $case){
        if(!$case->c_w_case_id){
            if($case->in_out == 'OUT'){
                if($role_id == 1 || $role_id == 8 || ($role_id == 7 && $emp_levels->location == $case->terminal_id) || ($role_id == 7 && $emp_levels->level_id < 3)){
                    $res = DB::table('apna_case_cctv')->where('case_id', $case->case_id)->first();
                    if($res){
                        $notifications++;
                        $n++;
                    }            
                }
            }    
        }
    }

    if($n > 0){
        if($n > 1){
            $case_spl = 'Cases';
        }else{
            $case_spl = 'Case';
        }
        $noti_link .= '<li><a href="'.url('/commodity_withdrawal').'" class="dropdown-item"><div><span class="label label-danger">'.$n.'</span> &nbsp;&nbsp;&nbsp;&nbsp;<b>New '.$case_spl.' for Commodity Withdrawal </b></div></a></li><li class="dropdown-divider"></li>';
    }

    $case_gen = CaseGen::getCasePaymentReceived();
    $n = 0;
    foreach($case_gen as $key => $case){        
        if(!$case->p_r_case_id){
            if($case->in_out == 'PASS'){
                if($role_id == 1 || $role_id == 8 || $role_id == 3){
                    $res = DB::table('apna_case_labour_payment')->where('case_id', $case->case_id)->first();
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }elseif($case->in_out == 'IN'){
                if($role_id == 1 || $role_id == 8 || $role_id == 3){
                    $res = DB::table('apna_case_warehouse_receipt')->where('case_id', $case->case_id)->first();
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }elseif($case->in_out == 'OUT'){
                if($role_id == 1 || $role_id == 8 || $role_id == 3){
                    $res = DB::table('apna_case_labour_payment')->where('case_id', $case->case_id)->first();
                    if($res){
                        $notifications++;
                        $n++;
                    }
                }
            }
        }
    }

    if($n > 0){
        if($n > 1){
            $case_spl = 'Cases';
        }else{
            $case_spl = 'Case';
        }
        $noti_link .= '<li><a href="'.url('/payment_received').'" class="dropdown-item"><div><span class="label label-danger">'.$n.'</span> &nbsp;&nbsp;&nbsp;&nbsp;<b>New '.$case_spl.' for Payment Received </b></div></a></li><li class="dropdown-divider"></li>';
    }


    //Notification Bell
    /*if($notifications > 0)
    {
        ?>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#notification_bell").get(0).play();
                setTimeout(function(){ $("#notification_bell").get(0).pause(); }, 2000);
            });
        </script>
        <?php
    }*/

?>
<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">

            <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            </div>
            <div class="navbar-header p-l-10">
                <h3 class="{{ ($role->role_id == 2)?'text-white':''}} p-t-15 f-s-20">
                @if($role->role_id == 2)
                    {{ ($details->user_type == 1)?'Seller':'Buyer' }}
                @else
                    {{ ucfirst($role_name->role) }}
                @endif
                 Dashboard</h3>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                 <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-danger">{{ $notifications }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        @if($noti_link)
                            {!! $noti_link !!}
                        @else
                            <li>
                                <div class="text-center link-block">
                                    <a href="javascript:;" class="dropdown-item">
                                        <strong>Empty Notification</strong>
                                    </a>
                                </div>
                            </li>
                        @endif
                    </ul>
                </li>

                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                       {{ csrf_field() }}
                    </form>
                </li>

            </ul>
        </nav>
    </div>