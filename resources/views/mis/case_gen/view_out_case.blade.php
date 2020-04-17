@extends('layouts.auth_app')
@section('content')
<?php
$currentuserid = Auth::user()->id;
$role = DB::table('user_roles')->where('user_id', $currentuserid)->first();
$role_id = $role->role_id;
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6">
        <h2>Case : {{ $case_id }}</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Case Details</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Case Details</h5>
                    <div class="ibox-tools">
                         <input type="button" onclick="printDiv('print_data')" class="btn btn-info btn-xs" value="&nbsp;&nbsp;&nbsp;Print&nbsp;&nbsp;&nbsp;" />
                    </div>
                </div>
            </div>

            <div class="ibox float-e-margins" id="print_data">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox">
                                <h3 class="f-s-20">Case ID - {{ $case_id }}</h3><br />
                                <ul class="list-unstyled file-list">
                                    <li class="col-md-4 f-s-14">Customer Name :  <b>{{ ($case_gen->cust_fname)?$case_gen->cust_fname:'N/A' }}</b></li>
                                    <li class="col-md-4 f-s-14">Terminal  :  <b>{{ ($case_gen->terminal_name)?$case_gen->terminal_name:'N/A' }}</b></li>
                                    <li class="col-md-4 f-s-14">Weight (Qtl.)  :  <b>{{ ($case_gen->total_weight)?$case_gen->total_weight:'N/A' }}</b></li>
                                    <li class="col-md-4 f-s-14">Commodity  :  <b>{{ ($case_gen->cate_name)?$case_gen->cate_name:'N/A' }}</b></li>
                                    <li class="col-md-4 f-s-14">Lead Generator  :  <b>{{ ($case_gen->lead_gen_fname)?$case_gen->lead_gen_fname:'N/A' }}</b></li>
                                    <li class="col-md-4 f-s-14">Lead Convertor  :  <b>{{ ($case_gen->lead_conv_fname)?$case_gen->lead_conv_fname:'N/A' }}</b></li>
                                    <li class="col-md-4 f-s-14">Commodity Type  :  <b>{{ ($case_gen->commodity_type)?$case_gen->commodity_type:'N/A' }}</b></li>
                                    <li class="col-md-4 f-s-14">Purpose  :  <b>{{ ($case_gen->purpose)?$case_gen->purpose:'N/A' }}</b></li>
                                    <li class="col-md-4 f-s-14">Date  :  <b>{{ ($case_gen->created_at)?$case_gen->created_at:'N/A' }}</b></li>
                                    <li class="col-md-4 f-s-14">UserName  :  <b>{{ ($case_gen->fpo_user_id)?$case_gen->fpo_user_id:'N/A' }}</b></li>
                                    <li class="col-md-4 f-s-14">Name in Gatepass / CDF :  <b>{{ ($case_gen->gate_pass_cdf_user_name)?$case_gen->gate_pass_cdf_user_name:'N/A' }}</b></li>
                                    <li class="col-md-4 f-s-14">Name in Coldwin  :  <b>{{ ($case_gen->coldwin_name)?$case_gen->coldwin_name:'N/A' }}</b></li>
                                    <li class="col-md-4 f-s-14">Purchase Details in Tally  :  <b>{{ ($case_gen->purchase_name)?$case_gen->purchase_name:'N/A' }}</b></li>
                                    <li class="col-md-4 f-s-14">Loan Details in Tally  :  <b>{{ ($case_gen->loan_name)?$case_gen->loan_name:'N/A' }}</b></li>
                                    <li class="col-md-4 f-s-14">Sale Details in Tally  :  <b>{{ ($case_gen->sale_name)?$case_gen->sale_name:'N/A' }}</b></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-12 m-t-20">
                            <div class="ibox">
                                <h3 class="f-s-20">Pricing</h3>
                                <ul class="list-unstyled file-list">
                                    <li class="col-md-4 f-s-14">Price :  <b>{{ ($case_gen->p_price)?$case_gen->p_price:'N/A' }}</b></li>
                                    <li class="col-md-4 f-s-14">Processing Fees(%) :  <b>{{ ($case_gen->p_processing_fees)?$case_gen->p_processing_fees:'N/A' }}</b></li>
                                    <li class="col-md-4 f-s-14">Rent (MT/Month) :  <b>{{ ($case_gen->p_rent)?$case_gen->p_rent:'N/A' }}</b></li>
                                    <li class="col-md-4 f-s-14">Interest Rate(%) :  <b>{{ ($case_gen->p_interest_rate)?$case_gen->p_interest_rate:'N/A' }}</b></li>
                                    <li class="col-md-4 f-s-14">Transaction Type(%) :  <b>{{ ($case_gen->p_transaction_type)?$case_gen->p_transaction_type:'N/A' }}</b></li>
                                    <li class="col-md-4 f-s-14">Labour Rate (%) :  <b>{{ ($case_gen->p_labour_rate)?$case_gen->p_labour_rate:'N/A' }}</b></li>
                                    <li class="col-md-12 f-s-14">Notes : <b>{{ ($case_gen->p_notes)?$case_gen->p_notes:'N/A' }}</b></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 m-t-20">
                            <div class="ibox">
                                <h3 class="f-s-20">Release Order</h3>
                                <ul class="list-unstyled file-list">
                                    <li class="col-md-2 f-s-14">File : <b>{!! ($case_gen->r_o_file)?'<a style="color:#1ab394;" href="'.url('/').'/resources/assets/upload/release_order/'.$case_gen->r_o_file.'" target="_blank">View</a>':'N/A' !!}</b></li>
                                    <li class="col-md-10 f-s-14">Notes : <b>{{ ($case_gen->r_o_notes)?$case_gen->r_o_notes:'N/A' }}</b></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 m-t-20">
                            <div class="ibox">
                                <h3 class="f-s-20">Delivery Order</h3>
                                <ul class="list-unstyled file-list">
                                    <li class="col-md-2 f-s-14">File : <b>{!! ($case_gen->d_o_file)?'<a style="color:#1ab394;" href="'.url('/').'/resources/assets/upload/delivery_order/'.$case_gen->d_o_file.'" target="_blank">View</a>':'N/A' !!}</b></li>
                                    <li class="col-md-10 f-s-14">Notes : <b>{{ ($case_gen->d_o_notes)?$case_gen->d_o_notes:'N/A' }}</b></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 m-t-20">
                            <div class="ibox">
                                <h3 class="f-s-20">Truck Book</h3>
                                <ul class="list-unstyled file-list">
                                    <li class="col-md-3 f-s-14">Transporter :  <b>{{ ($case_gen->t_b_transporter)?$case_gen->t_b_transporter:'N/A' }}</b></li>

                                    <li class="col-md-3 f-s-14">Vehicle No.:  <b>{{ ($case_gen->t_b_vehicle)?$case_gen->t_b_vehicle:'N/A' }}</b></li>

                                    <li class="col-md-3 f-s-14">Driver Name :  <b>{{ ($case_gen->t_b_driver_name)?$case_gen->t_b_driver_name:'N/A' }}</b></li>

                                    <li class="col-md-3 f-s-14">Driver Phone :  <b>{{ ($case_gen->t_b_driver_phone)?$case_gen->t_b_driver_phone:'N/A' }}</b></li>

                                    <li class="col-md-3 f-s-14">Tansport Rate/KM :  <b>{{ ($case_gen->t_b_rate_per_km)?$case_gen->t_b_rate_per_km:'N/A' }}</b></li>

                                    <li class="col-md-3 f-s-14">Min Weight(Qtl.) :  <b>{{ ($case_gen->t_b_min_weight)?$case_gen->t_b_min_weight:'N/A' }}</b></li>

                                    <li class="col-md-3 f-s-14">Max Weight(Qtl.) :  <b>{{ ($case_gen->t_b_max_weight)?$case_gen->t_b_max_weight:'N/A' }}</b></li>

                                    <li class="col-md-3 f-s-14">Turnaround Time  :  <b>{{ ($case_gen->t_b_turnaround_time)?$case_gen->t_b_turnaround_time:'N/A' }}</b></li>

                                    <li class="col-md-3 f-s-14">Total Weight (Qtl.) :  <b>{{ ($case_gen->t_b_total_weight)?$case_gen->t_b_total_weight:'N/A' }}</b></li>

                                    <li class="col-md-3 f-s-14">No of Bags :  <b>{{ ($case_gen->t_b_no_of_bags)?$case_gen->t_b_no_of_bags:'N/A' }}</b></li>

                                    <li class="col-md-3 f-s-14">Advance Payment  :  <b>{{ ($case_gen->t_b_advance_payment)?$case_gen->t_b_advance_payment:'N/A' }}</b></li>

                                    <li class="col-md-3 f-s-14">Total Transport Cost :  <b>{{ ($case_gen->t_b_total_transport_cost)?$case_gen->t_b_total_transport_cost:'N/A' }}</b></li>

                                    <li class="col-md-3 f-s-14">Start Date Time :  <b>{{ ($case_gen->t_b_start_date_time)?$case_gen->t_b_start_date_time:'N/A' }}</b></li>

                                    <li class="col-md-3 f-s-14">End Date Time :  <b>{{ ($case_gen->t_b_end_date_time)?$case_gen->t_b_end_date_time:'N/A' }}</b></li>

                                    <li class="col-md-3 f-s-14">Final Settlement :  <b>{{ ($case_gen->t_b_final_settlement_amount)?$case_gen->t_b_final_settlement_amount:'N/A' }}</b></li>

                                    <li class="col-md-12 f-s-14">Notes : <b>{{ ($case_gen->t_b_notes)?$case_gen->t_b_notes:'N/A' }}</b></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 m-t-20">
                            <div class="ibox">
                                <h3 class="f-s-20">Labour Book</h3>
                                <ul class="list-unstyled file-list">
                                    <li class="col-md-3 f-s-14">Labour Contractor :  <b>{{ ($case_gen->l_b_labour_contractor)?$case_gen->l_b_labour_contractor:'N/A' }}</b></li>

                                    <li class="col-md-3 f-s-14">Contractor Phone :  <b>{{ ($case_gen->l_b_contractor_no)?$case_gen->l_b_contractor_no:'N/A' }}</b></li>

                                    <li class="col-md-3 f-s-14">Labour Rate / Bags :  <b>{{ ($case_gen->l_b_labour_rate_per_bags)?$case_gen->l_b_labour_rate_per_bags:'N/A' }}</b></li>

                                    <li class="col-md-3 f-s-14">Total Labour :  <b>{{ ($case_gen->l_b_total_labour)?$case_gen->l_b_total_labour:'N/A' }}</b></li>

                                    <li class="col-md-3 f-s-14">Location :  <b>{{ ($case_gen->l_b_location)?$case_gen->l_b_location:'N/A' }}</b></li>

                                    <li class="col-md-3 f-s-14">Booking Date :  <b>{{ ($case_gen->l_b_booking_date)?$case_gen->l_b_booking_date:'N/A' }}</b></li>

                                    <li class="col-md-3 f-s-14">Total Bags :  <b>{{ ($case_gen->l_b_total_bags)?$case_gen->l_b_total_bags:'N/A' }}</b></li>

                                    <li class="col-md-12 f-s-14">Notes : <b>{{ ($case_gen->l_b_notes)?$case_gen->l_b_notes:'N/A' }}</b></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 m-t-20">
                            <div class="ibox">
                                <h3 class="f-s-20">First Quality Report </h3>
                                <ul class="list-unstyled file-list">
                                    <li class="col-md-2 f-s-14">Moisture Level(%) :  <b>{{ ($case_gen->q_r_moisture_level)?$case_gen->q_r_moisture_level:'N/A' }}</b></li>
                                    <li class="col-md-2 f-s-14">TCW(%) :  <b>{{ ($case_gen->q_r_thousand_crown_w)?$case_gen->q_r_thousand_crown_w:'N/A' }}</b></li>
                                    <li class="col-md-2 f-s-14">Broken(%) :  <b>{{ ($case_gen->q_r_broken)?$case_gen->q_r_broken:'N/A' }}</b></li>
                                    <li class="col-md-2 f-s-14">FM Level(%) :  <b>{{ ($case_gen->q_r_foreign_matter)?$case_gen->q_r_foreign_matter:'N/A' }}</b></li>
                                    <li class="col-md-2 f-s-14">Thin(%) :  <b>{{ ($case_gen->q_r_thin)?$case_gen->q_r_thin:'N/A' }}</b></li>
                                    <li class="col-md-2 f-s-14">DeHusk(%) :  <b>{{ ($case_gen->q_r_damage)?$case_gen->q_r_damage:'N/A' }}</b></li>
                                    <li class="col-md-2 f-s-14">Discolour(%) :  <b>{{ ($case_gen->q_r_black_smith)?$case_gen->q_r_black_smith:'N/A' }}</b></li>
                                    <li class="col-md-2 f-s-14">Infested(%) :  <b>{{ ($case_gen->q_r_infested)?$case_gen->q_r_infested:'N/A' }}</b></li>
                                    <li class="col-md-2 f-s-14">Live Insects(%) :  <b>{{ ($case_gen->q_r_live_insects)?$case_gen->q_r_live_insects:'N/A' }}</b></li>
                                    <li class="col-md-2 f-s-14">File : <b>{!! ($case_gen->q_r_imge)?'<a style="color:#1ab394;" href="'.url('/').'/resources/assets/upload/quality_report/'.$case_gen->q_r_imge.'" target="_blank">View</a>':'N/A' !!}</b></li>
                                    <li class="col-md-4 f-s-14">Notes : <b>{{ ($case_gen->q_r_notes)?$case_gen->q_r_notes:'N/A' }}</b></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 m-t-20">
                            <div class="ibox">
                                <h3 class="f-s-20">First Kanta Parchi</h3>
                                <ul class="list-unstyled file-list">
                                    <li class="col-md-2 f-s-14">File : <b>{!! ($case_gen->k_p_file)?'<a style="color:#1ab394;" href="'.url('/').'/resources/assets/upload/kanta_parchi/'.$case_gen->k_p_file.'" target="_blank">View</a>':'N/A' !!}</b></li>
                                    <li class="col-md-2 f-s-14">File : <b>{!! ($case_gen->k_p_file_2)?'<a style="color:#1ab394;" href="'.url('/').'/resources/assets/upload/kanta_parchi/'.$case_gen->k_p_file_2.'" target="_blank">View</a>':'N/A' !!}</b></li>
                                    <li class="col-md-10 f-s-14">Notes : <b>{{ ($case_gen->k_p_notes)?$case_gen->k_p_notes:'N/A' }}</b></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 m-t-20">
                            <div class="ibox">
                                <h3 class="f-s-20">Second Quality Report </h3>
                                <ul class="list-unstyled file-list">
                                    <li class="col-md-2 f-s-14">Moisture Level(%) :  <b>{{ ($case_gen->s_q_r_moisture_level)?$case_gen->s_q_r_moisture_level:'N/A' }}</b></li>
                                    <li class="col-md-2 f-s-14">TCW(%) :  <b>{{ ($case_gen->s_q_r_thousand_crown_w)?$case_gen->s_q_r_thousand_crown_w:'N/A' }}</b></li>
                                    <li class="col-md-2 f-s-14">Broken(%) :  <b>{{ ($case_gen->s_q_r_broken)?$case_gen->s_q_r_broken:'N/A' }}</b></li>
                                    <li class="col-md-2 f-s-14">FM Level(%) :  <b>{{ ($case_gen->s_q_r_foreign_matter)?$case_gen->s_q_r_foreign_matter:'N/A' }}</b></li>
                                    <li class="col-md-2 f-s-14">Thin(%) :  <b>{{ ($case_gen->s_q_r_thin)?$case_gen->s_q_r_thin:'N/A' }}</b></li>
                                    <li class="col-md-2 f-s-14">DeHusk(%) :  <b>{{ ($case_gen->s_q_r_damage)?$case_gen->s_q_r_damage:'N/A' }}</b></li>
                                    <li class="col-md-2 f-s-14">Discolour(%) :  <b>{{ ($case_gen->s_q_r_black_smith)?$case_gen->s_q_r_black_smith:'N/A' }}</b></li>
                                    <li class="col-md-2 f-s-14">Infested(%) :  <b>{{ ($case_gen->s_q_r_infested)?$case_gen->s_q_r_infested:'N/A' }}</b></li>
                                    <li class="col-md-2 f-s-14">Live Insects(%) :  <b>{{ ($case_gen->s_q_r_live_insects)?$case_gen->s_q_r_live_insects:'N/A' }}</b></li>
                                    <li class="col-md-2 f-s-14">File : <b>{!! ($case_gen->s_q_r_imge)?'<a style="color:#1ab394;" href="'.url('/').'/resources/assets/upload/second_quality_report/'.$case_gen->s_q_r_imge.'" target="_blank">View</a>':'N/A' !!}</b></li>
                                    <li class="col-md-4 f-s-14">Notes : <b>{{ ($case_gen->s_q_r_notes)?$case_gen->s_q_r_notes:'N/A' }}</b></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 m-t-20">
                            <div class="ibox">
                                <h3 class="f-s-20">Second Kanta Parchi</h3>
                                <ul class="list-unstyled file-list">
                                    <li class="col-md-2 f-s-14">File : <b>{!! ($case_gen->s_k_p_file)?'<a style="color:#1ab394;" href="'.url('/').'/resources/assets/upload/second_kanta_parchi/'.$case_gen->s_k_p_file.'" target="_blank">View</a>':'N/A' !!}</b></li>
                                    <li class="col-md-2 f-s-14">File : <b>{!! ($case_gen->s_k_p_file_2)?'<a style="color:#1ab394;" href="'.url('/').'/resources/assets/upload/second_kanta_parchi/'.$case_gen->s_k_p_file_2.'" target="_blank">View</a>':'N/A' !!}</b></li>
                                    <li class="col-md-10 f-s-14">Notes : <b>{{ ($case_gen->s_k_p_notes)?$case_gen->s_k_p_notes:'N/A' }}</b></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 m-t-20">
                            <div class="ibox">
                                <h3 class="f-s-20">Gate Pass</h3>
                                <ul class="list-unstyled file-list">
                                    <li class="col-md-2 f-s-14">File : <b>{!! ($case_gen->g_p_file)?'<a style="color:#1ab394;" href="'.url('/').'/resources/assets/upload/gate_pass/'.$case_gen->g_p_file.'" target="_blank">View</a>':'N/A' !!}</b></li>
                                    <li class="col-md-10 f-s-14">Notes : <b>{{ ($case_gen->g_p_notes)?$case_gen->g_p_notes:'N/A' }}</b></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 m-t-20">
                            <div class="ibox">
                                <h3 class="f-s-20">E-Mandi</h3>
                                <ul class="list-unstyled file-list">
                                    <li class="col-md-2 f-s-14">File : <b>{!! ($case_gen->e_m_file)?'<a style="color:#1ab394;" href="'.url('/').'/resources/assets/upload/e_mandi/'.$case_gen->e_m_file.'" target="_blank">View</a>':'N/A' !!}</b></li>
                                    <li class="col-md-10 f-s-14">Notes : <b>{{ ($case_gen->e_m_notes)?$case_gen->e_m_notes:'N/A' }}</b></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 m-t-20">
                            <div class="ibox">
                                <h3 class="f-s-20">CCTV</h3>
                                <ul class="list-unstyled file-list">
                                    <li class="col-md-2 f-s-14">File : <b>{!! ($case_gen->cctv_file)?'<a style="color:#1ab394;" href="'.url('/').'/resources/assets/upload/cctv/'.$case_gen->cctv_file.'" target="_blank">View</a>':'N/A' !!}</b></li>
                                    <li class="col-md-10 f-s-14">Notes : <b>{{ ($case_gen->cctv_notes)?$case_gen->cctv_notes:'N/A' }}</b></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 m-t-20">
                            <div class="ibox">
                                <h3 class="f-s-20">Commodity Withdrawal</h3>
                                <ul class="list-unstyled file-list">
                                    <li class="col-md-2 f-s-14">File : <b>{!! ($case_gen->c_w_file)?'<a style="color:#1ab394;" href="'.url('/').'/resources/assets/upload/commodity_withdrawal/'.$case_gen->c_w_file.'" target="_blank">View</a>':'N/A' !!}</b></li>
                                    <li class="col-md-10 f-s-14">Notes : <b>{{ ($case_gen->c_w_notes)?$case_gen->c_w_notes:'N/A' }}</b></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 m-t-20">
                            <div class="ibox">
                                <h3 class="f-s-20">Accounts</h3>
                                <ul class="list-unstyled file-list">
                                    <li class="col-md-2 f-s-14">Vikay Parchi :  <b>{{ ($case_gen->a_vikray_parchi)?$case_gen->a_vikray_parchi:'N/A' }}</b></li>

                                    <li class="col-md-2 f-s-14">Tally :  <b>{{ ($case_gen->a_tally_updation)?$case_gen->a_tally_updation:'N/A' }}</b></li>

                                    <li class="col-md-2 f-s-14">Coldwin :  <b>{{ ($case_gen->a_cold_win_entry)?$case_gen->a_cold_win_entry:'N/A' }}</b></li>

                                    <li class="col-md-2 f-s-14">Inventory :  <b>{{ ($case_gen->a_inventory)?$case_gen->a_inventory:'N/A' }}</b></li>

                                    <li class="col-md-2 f-s-14">Loan :  <b>{{ ($case_gen->a_loan)?$case_gen->a_loan:'N/A' }}</b></li>

                                    <li class="col-md-2 f-s-14">Sale :  <b>{{ ($case_gen->a_sale)?$case_gen->a_sale:'N/A' }}</b></li>

                                    <li class="col-md-2 f-s-14">Mandi Tax :  <b>{{ ($case_gen->a_mandi_tax)?$case_gen->a_mandi_tax:'N/A' }}</b></li>

                                    <li class="col-md-2 f-s-14">Purchase :  <b>{{ ($case_gen->a_purchase)?$case_gen->a_purchase:'N/A' }}</b></li>

                                    <li class="col-md-2 f-s-14">File : <b>{!! ($case_gen->a_invoice)?'<a style="color:#1ab394;" href="'.url('/').'/resources/assets/upload/accounts/'.$case_gen->a_invoice.'" target="_blank">View</a>':'N/A' !!}</b></li>

                                    <li class="col-md-6 f-s-14">Notes : <b>{{ ($case_gen->a_notes)?$case_gen->a_notes:'N/A' }}</b></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 m-t-20">
                            <div class="ibox">
                                <h3 class="f-s-20"> Shipping Start</h3>
                                <ul class="list-unstyled file-list">
                                    <li class="col-md-3 f-s-14">Location :  <b>{{ ($case_gen->s_s_location)?$case_gen->s_s_location:'N/A' }}</b></li>

                                    <li class="col-md-3 f-s-14">Date -Time :  <b>{{ ($case_gen->s_s_date_time)?$case_gen->s_s_date_time:'N/A' }}</b></li>

                                    <li class="col-md-6 f-s-14">Notes : <b>{{ ($case_gen->s_s_notes)?$case_gen->s_s_notes:'N/A' }}</b></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 m-t-20">
                            <div class="ibox">
                                <h3 class="f-s-20"> Shipping End</h3>
                                <ul class="list-unstyled file-list">
                                    <li class="col-md-3 f-s-14">Location :  <b>{{ ($case_gen->s_e_location)?$case_gen->s_e_location:'N/A' }}</b></li>

                                    <li class="col-md-3 f-s-14">Date -Time :  <b>{{ ($case_gen->s_e_date_time)?$case_gen->s_e_date_time:'N/A' }}</b></li>

                                    <li class="col-md-6 f-s-14">Notes : <b>{{ ($case_gen->s_e_notes)?$case_gen->s_e_notes:'N/A' }}</b></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 m-t-20">
                            <div class="ibox">
                                <h3 class="f-s-20">Quality Claim</h3>
                                <ul class="list-unstyled file-list">
                                    <li class="col-md-2 f-s-14">Moisture Level(%) :  <b>{{ ($case_gen->q_c_moisture_level)?$case_gen->q_c_moisture_level:'N/A' }}</b></li>
                                    <li class="col-md-2 f-s-14">TCW(%) :  <b>{{ ($case_gen->q_c_thousand_crown_w)?$case_gen->q_c_thousand_crown_w:'N/A' }}</b></li>
                                    <li class="col-md-2 f-s-14">Broken(%) :  <b>{{ ($case_gen->q_c_broken)?$case_gen->q_c_broken:'N/A' }}</b></li>
                                    <li class="col-md-2 f-s-14">FM Level(%) :  <b>{{ ($case_gen->q_c_foreign_matter)?$case_gen->q_c_foreign_matter:'N/A' }}</b></li>
                                    <li class="col-md-2 f-s-14">Thin(%) :  <b>{{ ($case_gen->q_c_thin)?$case_gen->q_c_thin:'N/A' }}</b></li>
                                    <li class="col-md-2 f-s-14">DeHusk(%) :  <b>{{ ($case_gen->q_c_damage)?$case_gen->q_c_damage:'N/A' }}</b></li>
                                    <li class="col-md-2 f-s-14">Discolour(%) :  <b>{{ ($case_gen->q_c_black_smith)?$case_gen->q_c_black_smith:'N/A' }}</b></li>
                                    <li class="col-md-2 f-s-14">Infested(%) :  <b>{{ ($case_gen->q_c_infested)?$case_gen->q_c_infested:'N/A' }}</b></li>
                                    <li class="col-md-2 f-s-14">Live Insects(%) :  <b>{{ ($case_gen->q_c_live_insects)?$case_gen->q_c_live_insects:'N/A' }}</b></li>
                                    <li class="col-md-2 f-s-14">Quality Discount Value :  <b>{{ ($case_gen->q_c_quality_discount_value)?$case_gen->q_c_quality_discount_value:'N/A' }}</b></li>
                                    <li class="col-md-2 f-s-14">File : <b>{!! ($case_gen->q_c_imge)?'<a style="color:#1ab394;" href="'.url('/').'/resources/assets/upload/quality_claim/'.$case_gen->q_c_imge.'" target="_blank">View</a>':'N/A' !!}</b></li>
                                    <li class="col-md-2 f-s-14">File 2 : <b>{!! ($case_gen->q_c_second_report)?'<a style="color:#1ab394;" href="'.url('/').'/resources/assets/upload/quality_claim/'.$case_gen->q_c_second_report.'" target="_blank">View</a>':'N/A' !!}</b></li>
                                    <li class="col-md-12 f-s-14">Notes : <b>{{ ($case_gen->q_c_notes)?$case_gen->q_c_notes:'N/A' }}</b></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 m-t-20">
                            <div class="ibox">
                                <h3 class="f-s-20">Truck Payment</h3>
                                <ul class="list-unstyled file-list">
                                    <li class="col-md-2 f-s-14">File : <b>{!! ($case_gen->t_p_file)?'<a style="color:#1ab394;" href="'.url('/').'/resources/assets/upload/truck_payment/'.$case_gen->t_p_file.'" target="_blank">View</a>':'N/A' !!}</b></li>
                                    <li class="col-md-10 f-s-14">Notes : <b>{{ ($case_gen->t_p_notes)?$case_gen->t_p_notes:'N/A' }}</b></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 m-t-20">
                            <div class="ibox">
                                <h3 class="f-s-20">Labour Payment</h3>
                                <ul class="list-unstyled file-list">
                                    <li class="col-md-2 f-s-14">File : <b>{!! ($case_gen->l_p_file)?'<a style="color:#1ab394;" href="'.url('/').'/resources/assets/upload/labour_payment/'.$case_gen->l_p_file.'" target="_blank">View</a>':'N/A' !!}</b></li>
                                    <li class="col-md-10 f-s-14">Notes : <b>{{ ($case_gen->l_p_notes)?$case_gen->l_p_notes:'N/A' }}</b></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 m-t-20">
                            <div class="ibox">
                                <h3 class="f-s-20">Payment Received</h3>
                                <ul class="list-unstyled file-list">
                                    <li class="col-md-2 f-s-14">File : <b>{!! ($case_gen->p_r_file)?'<a style="color:#1ab394;" href="'.url('/').'/resources/assets/upload/payment_received/'.$case_gen->p_r_file.'" target="_blank">View</a>':'N/A' !!}</b></li>
                                    <li class="col-md-10 f-s-14">Notes : <b>{{ ($case_gen->p_r_notes)?$case_gen->p_r_notes:'N/A' }}</b></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        w = window.open();

        w.document.write(printContents);
        w.document.write('<scr' + 'ipt type="text/javascript">' + 'window.onload = function() { window.print(); window.close(); };' + '</sc' + 'ript>');

        w.document.close(); // necessary for IE >= 10
        w.focus(); // necessary for IE >= 10

        return true;
    }
</script>
@endsection
