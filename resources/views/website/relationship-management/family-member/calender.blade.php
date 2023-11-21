@extends('layouts.app')

@section('content')
<style>
.birthday_section{
    background-image: url('/assets/img/login.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    padding: 10px 0px
}
.page-header-icon img {
    width: 40px;
    height: 40px;
    -o-object-fit: contain;
    object-fit: contain;
    -o-object-position: left center;
    object-position: left center;
    display: block;
    margin-left: auto;
    margin-right: auto;
}
.member-name{
    text-align: center;
    font-weight: 500;
    display: block;
}
</style>
<div class="birthday_section">
    <div class="page-haeder-path px-3">
        <h2 class="text-uppercase">{{ translate('messages.relationship_management') }} <i
                class="fas fa-chevron-right"></i> {{
            translate('messages.birthdays') }}</h2>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title text-capitalize">{{ translate('messages.birthday_calender') }}</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive mt-4">
                    <table class="table table-bordered" style="border-top: 1px solid #dee2e6; border-bottom: 1px solid #dee2e6;">
                        <thead>
                            <tr>
                                <th><a href="{{url('relationship-management/family-member/birthdays/'.$prev_year.'/'.$prev_month)}}" class="text-dark"><i class="fa fa-arrow-left"></i> {{translate('messages.Previous')}}</a></th>
                                <th colspan="5" class="text-center">{{date("F", strtotime($year.'-'.$month.'-01')).' ' .$year}}</th>
                                <th class="text-end"><a href="{{url('relationship-management/family-member/birthdays/'.$next_year.'/'.$next_month)}}" class="text-dark">{{translate('messages.Next')}} <i class="fa fa-arrow-right"></i></a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Sunday</strong></td>
                                <td><strong>Monday</strong></td>
                                <td><strong>Tuesday</strong></td>
                                <td><strong>Wednesday</strong></td>
                                <td><strong>Thrusday</strong></td>
                                <td><strong>Friday</strong></td>
                                <td><strong>Saturday</strong></td>
                            </tr>
                            <?php 
                                $i = 1;
                                $flag = 0;
                                while ($i <= $number_of_day) {
                                    echo '<tr>';
                                    for ($j=1 ; $j<=7 ; $j++) { 
                                        if($i > $number_of_day)
                                            break;
                                        if ($flag) {
                                            if($year.'-'.$month.'-'.$i == date('Y').'-'.date('m').'-'.(int)date('d'))
                                                echo '<td><p style="color:red"><strong>'.$i.'</strong></p>';
                                            else
                                                echo '<td><p><strong>'.$i.'</strong></p>';
                                            if($member_name[$i]){
						    					echo '<span class="page-header-icon"><img src="' . asset('assets/img/cake.png') . '"></span><span class="member-name">Today\'s ' . $member_name[$i] . ' Birthday</span>';
						    				}
						    				if($position[$i]){
						    					echo '<span class="member-name">'.$position[$i].'</span>';
						    				}
                                            echo '</td>';
                                            $i++;
                                        }elseif ($j == $start_day) {
                                            if($year.'-'.$month.'-'.$i == date('Y').'-'.date('m').'-'.(int)date('d'))
                                                echo '<td><p style="color:red"><strong>'.$i.'</strong></p>';
                                            else
                                                echo '<td><p><strong>'.$i.'</strong></p>';
                                            if($member_name[$i]){
						    					echo '<span class="page-header-icon"><img src="' . asset('assets/img/cake.png') . '"></span><span class="member-name">Today\'s ' . $member_name[$i] . ' Birthday</span>';
						    				}
						    				if($position[$i]){
						    					echo '<span class="member-name">'.$position[$i].'</span>';
						    				}
                                            echo '</td>';
                                            $flag = 1;
                                            $i++;
                                            continue;
                                        }
                                        else {
                                            echo '<td></td>';
                                        }
                                    }
                                    echo '</tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection