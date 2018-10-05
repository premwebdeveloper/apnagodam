@extends('layouts.public_app')

@section('content')

<header class="masthead text-white d-flex masthalf"></header>
<section id="about">

    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <h2 class="section-heading text-center">{{ __('Terms & Conditions') }}</h2>
                <hr>
                <h4>General Terms and Conditions :</h4> 
                <ol>
                    <li>The terms and condition for disposal of perishable or deteriorating goods, delivery requirements, liability as well as storage terms and conditions will be as per the terms and conditions specified under the State Warehousing Act, Rules where applicable and other applicable laws.</li>
                    <li>The storage charges for a particular commodity and storage location will be as notified by the Company from time to time.</li>
                    <li>It shall be the responsibility of the depositors that he fulfill the statutory requirements of Central, State, local administration; both for holding of stock as well as to ensure the quality of stocks as per FSSAI and other regulations.</li>
                </ol> 
            </div>
        </div>
    </div>
</section>
@endsection
