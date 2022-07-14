@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Referral Points</div>

                <div class="card-body">
                    <h4>{{ $referral_points }}</h4>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Sucessful Referrals</div>

                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Referral Name</th>
                                <th>Registration Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($successful_referrals as $successful_referral)
                                <tr>
                                    <td>{{ $successful_referral->name }}</td>
                                    <td>{{ $successful_referral->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
