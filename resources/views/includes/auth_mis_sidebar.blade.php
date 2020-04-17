<?php
$currentuserid = Auth::user()->id;
$emp_levels = DB::table('emp_levels')->where('user_id', $currentuserid)->first();
?>
<style type="text/css">
    .nav-header
    {
        padding: 15px 25px;
    }
</style>

<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="logo-element p-t-0" style="padding-bottom: 0px!important;">
                    <img style="width: 100%;" src="{{ asset('resources/frontend_assets/img/apna-godam-logo-1.png') }}">
                </div>
                <div class="dropdown profile-element text-center">
                    <span>
                        @if($role->role_id != 2 && $role->role_id != 4 )
                        <img alt="image" class="img-circle" src="{{ asset('resources/assets/upload/profile_image/admin.png') }}" style="background: #fff;width: 100px;"/>
                        @else
                        <img alt="image" class="img-circle" src="{{ asset('resources/assets/upload/profile_image/') }}/{{ ($details->image)?$details->image:'admin.png' }}" style="background: #fff;width: 100px;"/>
                        @endif
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ $user->fname }} {{ $user->lname }}</strong>
                        <b class="caret"></b> </span>  </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li>
                            <a href="{{ route('/') }}">
                                <i class="fa fa-globe" aria-hidden="true"></i> Go to Website
                            </a>
                        </li>
                        @if($role->role_id != 1 && $role->role_id != 2 && $role->role_id != 4)
                            <li>
                                <a href="{{ route('emp-profile', ['id' => $user->id]) }}">
                                    <i class="fa fa-user" aria-hidden="true"></i> Profile
                                </a>
                            </li>
                        @endif
                        @if($role->role_id == 2)
                            <li>
                                <a href="{{ route('profile') }}">
                                    <i class="fa fa-user-circle-o" aria-hidden="true"></i> My Profile
                                </a>
                            </li>
                        @endif
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
                </div>
            </li>
            @if($role->role_id == 1)
                <li>
                    <a href="{{ route('dashboard') }}">
                        <i class="fa fa-dashboard" title="Dashboard"></i>
                        <span class="nav-label">Back to Dashboard</span>
                    </a>
                </li>                
            @endif
            @if($role->role_id == 3 && $emp_levels->level_id == 1)
                <li>
                    <a href="{{ route('all-users') }}">
                        <i class="fa fa-users" title=""></i>
                        <span class="nav-label">Users</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('finance') }}" title="Finance / Loan" data-toggle="tooltip" data-placement="top">
                        <i class="fa fa-money"></i>
                        <span class="nav-label">Finance / Loan</span>
                    </a>
                </li>
            @endif
            @if($role->role_id == 5)
                <li>
                    <a href="{{ route('inventory') }}">
                        <i class="fa fa-houzz" title=""></i>
                        <span class="nav-label">Inventory</span>
                    </a>
                </li>
            @endif
            @if($role->role_id == 1 || $role->role_id == 3 || $role->role_id == 6 || $role->role_id == 8 || $role->role_id == 7 || $role->role_id == 9 || $role->role_id == 11)
                <li>
                    <a href="{{ route('leads') }}">
                        <i class="fa fa-book" title=""></i>
                        <span class="nav-label">Lead Generate</span>
                    </a>
                </li>
            @endif
            
            @if($role->role_id != 2 || $role->role_id != 4)
                <li>
                    <a href="{{ route('caseGen') }}">
                        <i class="fa fa-briefcase" title=""></i>
                        <span class="nav-label">Case ID</span>
                    </a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-tasks"></i> <span class="nav-label">PASS</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse" aria-expanded="false">
                        <li>
                            <a href="{{ route('quality_report') }}">
                                <i class="fa fa-check-circle" title=""></i>
                                <span class="nav-label">First Quality Report</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pricing') }}">
                                <i class="fa fa-money" title=""></i>
                                <span class="nav-label">Pricing</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('truck_book') }}">
                                <i class="fa fa-truck" title=""></i>
                                <span class="nav-label">Truck Book</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('labour_book') }}">
                                <i class="fa fa-user" title=""></i>
                                <span class="nav-label">Labour Book</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('kanta_parchi') }}">
                                <i class="fa fa-file" title=""></i>
                                <span class="nav-label">First Kanta Parchi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('second_quality_report') }}">
                                <i class="fa fa-check-circle" title=""></i>
                                <span class="nav-label">Second Quality Report</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('second_kanta_parchi') }}">
                                <i class="fa fa-file" title=""></i>
                                <span class="nav-label">Second Kanta Parchi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('gate_pass') }}">
                                <i class="fa fa-ticket" title=""></i>
                                <span class="nav-label">Gate Pass</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('e_mandi') }}">
                                <i class="fa fa-globe" title=""></i>
                                <span class="nav-label">E-Mandi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('accounts') }}">
                                <i class="fa fa-pencil" title=""></i>
                                <span class="nav-label">Accounts</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('ivr_tagging') }}">
                                <i class="fa fa-pencil" title=""></i>
                                <span class="nav-label">IVR Tagging</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('shipping_start') }}">
                                <i class="fa fa-truck" title=""></i>
                                <span class="nav-label">Shipment Start</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('shipping_end') }}">
                                <i class="fa fa-truck" title=""></i>
                                <span class="nav-label">Shipment End</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('quality_claim') }}">
                                <i class="fa fa-check-circle" title=""></i>
                                <span class="nav-label">Quality Claim</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('truck_payment') }}">
                                <i class="fa fa-money" title=""></i>
                                <span class="nav-label">Truck Payment</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('labour_payment') }}">
                                <i class="fa fa-money" title=""></i>
                                <span class="nav-label">Labour Payment</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('payment_received') }}">
                                <i class="fa fa-handshake-o" title=""></i>
                                <span class="nav-label">Payment Received</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-indent"></i> <span class="nav-label">IN</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse" aria-expanded="false">
                        <li>
                            <a href="{{ route('pricing') }}">
                                <i class="fa fa-money" title=""></i>
                                <span class="nav-label">Pricing</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('truck_book') }}">
                                <i class="fa fa-truck" title=""></i>
                                <span class="nav-label">Truck Book</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('labour_book') }}">
                                <i class="fa fa-user" title=""></i>
                                <span class="nav-label">Labour Book</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('kanta_parchi') }}">
                                <i class="fa fa-file" title=""></i>
                                <span class="nav-label">First Kanta Parchi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('quality_report') }}">
                                <i class="fa fa-check-circle" title=""></i>
                                <span class="nav-label">First Quality Report</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('second_kanta_parchi') }}">
                                <i class="fa fa-file" title=""></i>
                                <span class="nav-label">Second Kanta Parchi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('second_quality_report') }}">
                                <i class="fa fa-check-circle" title=""></i>
                                <span class="nav-label">Second Quality Report</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('gate_pass') }}">
                                <i class="fa fa-ticket" title=""></i>
                                <span class="nav-label">Gate Pass</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('e_mandi') }}">
                                <i class="fa fa-globe" title=""></i>
                                <span class="nav-label">E-Mandi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('quality_claim') }}">
                                <i class="fa fa-check-circle" title=""></i>
                                <span class="nav-label">Quality Claim</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('cctv') }}">
                                <i class="fa fa-video-camera" title=""></i>
                                <span class="nav-label">CCTV</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('commodity_deposit') }}">
                                <i class="fa fa-list" title=""></i>
                                <span class="nav-label">Commodity Deposit</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('accounts') }}">
                                <i class="fa fa-pencil" title=""></i>
                                <span class="nav-label">Accounts</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('ivr_tagging') }}">
                                <i class="fa fa-pencil" title=""></i>
                                <span class="nav-label">IVR Tagging</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('truck_payment') }}">
                                <i class="fa fa-money" title=""></i>
                                <span class="nav-label">Truck Payment</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('labour_payment') }}">
                                <i class="fa fa-money" title=""></i>
                                <span class="nav-label">Labour Payment</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('warehouse_receipt') }}">
                                <i class="fa fa-file-text" title=""></i>
                                <span class="nav-label">Warehouse Receipt</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('storage_receipt') }}">
                                <i class="fa fa-print" title=""></i>
                                <span class="nav-label">Storage Receipt</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('payment_received') }}">
                                <i class="fa fa-handshake-o" title=""></i>
                                <span class="nav-label">Payment Received</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-tasks"></i> <span class="nav-label">OUT</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse" aria-expanded="false">
                        <li>
                            <a href="{{ route('pricing') }}">
                                <i class="fa fa-money" title=""></i>
                                <span class="nav-label">Pricing</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('release_order') }}">
                                <i class="fa fa-first-order" title=""></i>
                                <span class="nav-label">Release Order</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('delivery_order') }}">
                                <i class="fa fa-handshake-o" title=""></i>
                                <span class="nav-label">Delivery Order</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('truck_book') }}">
                                <i class="fa fa-truck" title=""></i>
                                <span class="nav-label">Truck Book</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('labour_book') }}">
                                <i class="fa fa-user" title=""></i>
                                <span class="nav-label">Labour Book</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('quality_report') }}">
                                <i class="fa fa-check-circle" title=""></i>
                                <span class="nav-label">First Quality Report</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('kanta_parchi') }}">
                                <i class="fa fa-file" title=""></i>
                                <span class="nav-label">First Kanta Parchi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('second_quality_report') }}">
                                <i class="fa fa-check-circle" title=""></i>
                                <span class="nav-label">Second Quality Report</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('second_kanta_parchi') }}">
                                <i class="fa fa-file" title=""></i>
                                <span class="nav-label">Second Kanta Parchi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('gate_pass') }}">
                                <i class="fa fa-ticket" title=""></i>
                                <span class="nav-label">Gate Pass</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('e_mandi') }}">
                                <i class="fa fa-globe" title=""></i>
                                <span class="nav-label">E-Mandi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('cctv') }}">
                                <i class="fa fa-video-camera" title=""></i>
                                <span class="nav-label">CCTV</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('commodity_withdrawal') }}">
                                <i class="fa fa-money" title=""></i>
                                <span class="nav-label">Commodity Withdrawal</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('case_inventory') }}">
                                <i class="fa fa-file" title=""></i>
                                <span class="nav-label">Inventory</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('accounts') }}">
                                <i class="fa fa-pencil" title=""></i>
                                <span class="nav-label">Accounts</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('ivr_tagging') }}">
                                <i class="fa fa-pencil" title=""></i>
                                <span class="nav-label">IVR Tagging</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('shipping_start') }}">
                                <i class="fa fa-truck" title=""></i>
                                <span class="nav-label">Shipment Start</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('shipping_end') }}">
                                <i class="fa fa-truck" title=""></i>
                                <span class="nav-label">Shipment End</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('quality_claim') }}">
                                <i class="fa fa-check-circle" title=""></i>
                                <span class="nav-label">Quality Claim</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('truck_payment') }}">
                                <i class="fa fa-money" title=""></i>
                                <span class="nav-label">Truck Payment</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('labour_payment') }}">
                                <i class="fa fa-money" title=""></i>
                                <span class="nav-label">Labour Payment</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('payment_received') }}">
                                <i class="fa fa-handshake-o" title=""></i>
                                <span class="nav-label">Payment Received</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @if($role->role_id == 1)
                    <li>
                        <a href="#"><i class="fa fa-spinner"></i> <span class="nav-label">Approval Cases</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse" aria-expanded="false">
                            <li>
                                <a href="{{ route('approvalCasesPass') }}">
                                    <i class="fa fa-money" title=""></i>
                                    <span class="nav-label">PASS</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('approvalCasesIn') }}">
                                    <i class="fa fa-truck" title=""></i>
                                    <span class="nav-label">IN</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('approvalCasesOut') }}">
                                    <i class="fa fa-truck" title=""></i>
                                    <span class="nav-label">OUT</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                <li>
                    <a href="#"><i class="fa fa-line-chart"></i> <span class="nav-label">Cases Status</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse" aria-expanded="false">
                        <li>
                            <a href="{{ route('casesStatusPass') }}">
                                <i class="fa fa-money" title=""></i>
                                <span class="nav-label">PASS</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('casesStatusIn') }}">
                                <i class="fa fa-truck" title=""></i>
                                <span class="nav-label">IN</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('casesStatusOut') }}">
                                <i class="fa fa-truck" title=""></i>
                                <span class="nav-label">OUT</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('completedCases') }}">
                        <i class="fa fa-check-square-o" title=""></i>
                        <span class="nav-label">Completed Cases</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('cancelledCases') }}">
                        <i class="fa fa-ban" title=""></i>
                        <span class="nav-label">Cancelled Cases</span>
                    </a>
                </li>
                @if($role->role_id == 1)
                    <li>
                        <a href="{{ route('user_permissions') }}">
                            <i class="fa fa-users" title=""></i>
                            <span class="nav-label">User Permissions</span>
                        </a>
                    </li>
                @endif
                @if($role->role_id == 1 || $role->role_id == 14)
                    <li>
                        <a href="{{ route('cancelledCases') }}">
                            <i class="fa fa-camera" title=""></i>
                            <span class="nav-label">CCTV Audit</span>
                        </a>
                    </li>
                @endif
            @endif
		</ul>
	</div>
</nav>