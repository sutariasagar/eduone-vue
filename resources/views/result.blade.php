<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Welcome</title>

    <style type="text/css">
        body { font-family:  "Times New Roman", Times, serif; }
        .container { max-width: 800px; margin: 0 auto;}
        .container .clbl { color: #3c4da1; }
        .container .left{width:60%;display: inline-block;}
        .container .right{width:39%;display: inline-block;}
        /*.container .left, .right { width: 49%; display: inline-block;}*/
        .container .left{ vertical-align: top; }
        .container .right { text-align: right; position: relative; }
        .container .right img { border: 1px solid; margin-top: 100px;margin-right: 00px}
        .container .rotate {
            -ms-transform: rotate(90deg); /* IE 9 */
            -webkit-transform: rotate(90deg); /* Safari 3-8 */
            transform: rotate(90deg);
            position: absolute;
            right:-140px;
            margin-top: 120px;
        }
        .container .title { font-size: 24px;margin-bottom: 7px;}
        .container .name { font-weight: bold; font-size: 20px; color: #424141; }
        .container table { text-align: left; width: 100%;margin-top: 20px; font-size: 10px; }
        .container table th { min-width: 170px; color: #424242; }
        .container table.tableskil th.cols { padding-left: 0px; }
        .container table.tableskil td { padding-left: 10px; }
        .container .padt { padding-top: 10px; }
        .container .content { clear: both; width: 100%; margin-top: 15px; }
        .container .score { background-color: #3c4da1; padding: 5px 15px; color: #fff; margin-top: 10px; min-width: 140px; text-align: center;}
        .container p {font-size: 10px;}
        .container .lsec, .rsec { display: inline-block; vertical-align: top; }
        .container .lsec { width: 25%; }
        .container .rsec { width: 30%; }
        .container .f15 { font-size: 11px; }
        .container .scoreline { background-color: #3c4da1; color: #fff;width: 100%; padding: 10px 0px;}
        .container .scoreline small { padding: 0px 15px; }
        .container .scoreline b { padding: 0px 15px; float: right; }
        .grey{
            color: #818185;
        }
        .graph{
            border: 2px solid black; height: 300px; width: 70% !important; background-color: #d6d6da
        }
        .g-left{
            width: 25%; border-right: 1px solid black;float: left;
        }
        .g-right{
            width: 75%;float: right; padding-left: 0px !important;
        }
        .g-score { background-color: #349CF7; width: 10%; height: 15px; margin-top:2px;margin-bottom:2px;border: 1px solid black}
        .g-score-enabling { background-color: rgba(52, 156, 247, 0.58); width: 10%; height: 15px; margin-top:2px;margin-bottom:2px; border: 1px solid black}
        .ruler {
            position: relative;
            width: 360px;
            height: 5px;
        }
        .score-scale{
            position: absolute;
            border-right: 1px solid black;
            height: 240px;
            top:0px;
            display: inline-block;
        }
        .score-scale-text{
            position: absolute;
            top:0px;
            display: inline-block;
            width: 100px;
        }
        .ruler .cm,
        .ruler .mm {
            position: absolute;
            height: 5px;
            display: inline-block;
            top:0px;
        }
        span{font-size: 10px; text-align: right}

    </style>
</head>
<body>
<div class="container">
    <div class="left">
        <div class="head">
            <div class="clbl title"><b>PTE</b> Academic Mock Test</div>
            <div class="clbl title">Test Taker Score Report</div>
            <div class="name">{{$student->first_name}} @if($student->middle_name){{$student->middle_name}} @endif {{$student->last_name}}</div>
        </div>
        <table>
            <tr>
                <th>Test Taker ID:</th>
                <td class="grey">@if($student->test_taker_id){{$student->test_taker_id}} @endif</td>
            </tr>
            <tr>
                <th class="padt">Date of Birth:</th>
                <td class="grey padt">@if($student->date_of_birth){{$student->date_of_birth}} @endif</td>
            </tr>
            <tr>
                <th>Country of Citizenship:</th>
                <td class="grey">@if($student->country){{$student->country}} @endif</td>
            </tr>
            <tr>
                <th>Country of Residence:</th>
                <td class="grey">@if($student->country){{$student->country}} @endif</td>
            </tr>
            <tr>
                <th>Gender:</th>
                <td class="grey">@if($student->gender){{$student->gender}} @endif</td>
            </tr>
            <tr>
                <th>Email Address:</th>
                <td class="grey">@if($student->email) {{$student->email}} @endif</td>
            </tr>
            <tr>
                <th class="padt">Registration ID:</th>
                <td class="grey padt">@if($student->registration_id) {{$student->registration_id}} @endif</td>
            </tr>
            <tr>
                <th class="padt">Test Date:</th>
                <td class="grey padt">@if($examUser->created_at) {{Carbon\Carbon::parse($examUser->created_at)->format('d F Y')}} @endif</td>
            </tr>
            <tr>
                <th>Test Centre Country:</th>
                <td class="grey">India</td>
            </tr>
            <tr>
                <th>Test Centre ID:</th>
                <td class="grey">81606</td>
            </tr>
            <tr>
                <th>First-Time Test Taker:</th>
                <td class="grey">Yes</td>
            </tr>
            <tr>
                <th class="padt">Report Issue Date:</th>
                <td class="grey padt">{{ date('d-m-Y H:i:s') }}</td>
            </tr>

        </table>
    </div>
    <div class="right">
        <div class="rotate">@if($student->last_name) {{$student->last_name}} @endif, {{$student->first_name}} &nbsp;&nbsp;&nbsp;&nbsp; {{$student->registration_id}}</div>             
        @if($student->capture_image)                  
            <img src="{{$student->capture_image}}" alt="Photo" width="150" height="200" style="margin-right:50px!important">            
        @else
            <img src="https://mm.aiircdn.com/158/834329.jpg" alt="Photo" width="125">
        @endif
    </div>

    <div class="content">
        <div class="score" style="width: 10%">Overall Score: {{$overall_communicative_skills}}</div>
        <p>The Overall Score of this mock test is calculated automatically with complex calculations and cannot be derived with simplistic calculations directly from the Communicative Skills or Enabling Skills score as these scores depend on many items. As part of our sincere efforts to provide assessments closest to the actual PTE Academic, we try to ensure that our results are fast, accurate and give a fair idea of test-takers’ preparation.
        </p>
    </div>
    <div class="content">
        <div class="score" style="width: 10%">Skill Profile</div>
        <div class="lsec">
            <table class="tableskil">
                <tr>
                    <th colspan="2" class="cols">Communicative Skills</th>
                </tr>

                @foreach($communicative_skills as $skill=>$score)
                    <tr>
                        <td>{{$skill}}</td>
                        <td>{{$score['skill_score']}}</td>
                        {{--<td>{{$skill->actual_score}}</td>--}}
                    </tr>

                @endforeach

                <tr>
                    <th colspan="2" class="cols padt">Enabling Skills</th>
                </tr>
                @foreach($enabling_skills as $skill=>$score)
                    <tr>
                        <td>{{$skill}}</td>
                        <td>{{$score['skill_score']}}</td>
                        {{--<td>{{$skill->actual_score}}</td>--}}
                    </tr>

                @endforeach
            </table>
        </div>
        <div class="rsec graph" style="padding-top: 10px">
            <div class="g-left">
                <p style="padding-left: 20px"><b>Communicative Skill</b></p>
                @foreach($communicative_skills as $skill=>$score)
                        <p style="text-align:right; padding-right: 10px;height: 15px;margin-top:3px;margin-bottom:2px; border: 1px solid transparent">{{$skill}}</p>
                @endforeach

                <p style="padding-left: 20px"><b>Enabling Skill</b></p>
                @foreach($enabling_skills as $skill=>$score)
                        <p style="text-align:right; padding-right: 10px;height: 15px;margin-top:2px;margin-bottom:2px; border: 1px solid transparent">{{$skill}}</p>
                @endforeach
            </div>
            <div class="g-righ" style="position:absolute;right:37px; width: 360px;">
                <p><b>&nbsp;</b></p>
                @foreach($communicative_skills as $skill=>$score)
                    <p class="g-score" style="width: {{($score['skill_score'] * 4)-40}}px">&nbsp;</p>
                @endforeach

                <p><b>&nbsp;</b></p>
                @foreach($enabling_skills as $skill=>$score)
                    <p class="g-score-enabling" style="width: {{($score['skill_score'] * 4)-40}}px">&nbsp;</p>
                @endforeach
                <p style="border-bottom:1px solid black; width: 360px; margin: 0px;" ></p>
                <p class="score-scale-text" style="left: {{($overall_communicative_skills * 4)-80}}px;"><b>Overall Score</b></p>
                <p class="score-scale" style="width: {{($overall_communicative_skills * 4)-40}}px;"></p>
                <div class='ruler'>
                    @for($i=10; $i<=90; $i++)
                        @if(($i-2)%4 == 0)
                        <div class='cm' style="left:{{(($i-10)*4)-4}}px; top: 5px">
                            <span>{{$i}}</span>
                        </div>
                        @else
                            <div class='mm' style="left:{{(($i-10)*4)-4 }}px;">

                            </div>
                        @endif
                    @endfor
                </div>

            </div>
        </div>
    </div>
    <div class="content">
        <div class="scoreline"><small></small> <b>PTE Topper</b></div>
    </div>
</div>
<script>

</script>
</body>
</html>