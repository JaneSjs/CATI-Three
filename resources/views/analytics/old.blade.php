<!DOCTYPE html>
<html lang="en">

<head>
    <title> Loading your Analytics - </title>
    <meta name="viewport" content="width=device-width" />
    <script src="https://unpkg.com/jquery"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://unpkg.com/survey-jquery@1.8.20/survey.jquery.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    <script src="https://cdn.rawgit.com/inexorabletash/polyfill/master/typedarray.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js"></script>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <script src="https://unpkg.com/wordcloud@1.1.0/src/wordcloud2.js"></script>
    <link href="https://unpkg.com/survey-analytics@1.8.20/survey.analytics.min.css" rel="stylesheet" />
    <script src="https://unpkg.com/survey-analytics@1.8.20/survey.analytics.min.js"></script>
    <style>
        .sa-commercial {
            display: none !important;
        }
    </style>
</head>

<body>

<div class="container">
        <h1> </h1> <br />
        <hr />
        <small>Please note that not all questions can be visualized.</small>

    </div>
    <div id="loader-wrapper">
        <h5 style="color: aliceblue">We are loading your data</h5>
        <div id="loader"></div>

        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>

    </div>

    <div class="container-fluid" id="content">
        <div id="surveyElement" style="display:inline-block;width:100%;"></div>
        <div id="surveyResult"></div>
    </div>




    <script>
        var datas = {!! json_encode($survey[0]) !!};
// var json =JSON.stringify({!! json_encode($survey[0]) !!}) ;

// console.log(datas.pages);

var newdatas;

// datas.pages.forEach()
let obj1 = datas.pages.find(o => o.name === 'ODEMOS')
//let obj1 = datas.pages.find(o => o.name === 'page1')
let obj = datas.pages.find(o => o.name === 'ADDITIONAL')

//let obj = datas.pages.find(o => o.name === 'SC QUESTIONS')

let obj2 = datas.pages.find(o => o.name === 'PERCEPTIONS')
let obj3 = datas.pages.find(o => o.name === 'SKINCARE')
let obj4 = datas.pages.find(o => o.name === 'TF')
// console.log(obj)

newdatas = arrayRemove(datas.pages, obj);

anotherdata = arrayRemove(newdatas, obj1);

anotherdata = arrayRemove(anotherdata, obj2);

anotherdata = arrayRemove(anotherdata, obj3);

anotherdata = arrayRemove(anotherdata, obj4);

console.log(newdatas)

datas.pages = anotherdata

console.log(datas.pages);

var json =  JSON.stringify(datas);

// console.log(newdatas)

function arrayRemove(arr, value) { return arr.filter(function(ele){ return ele != value; });}

var survey = new Survey.Model(json);

var surveyResultNode = document.getElementById("surveyResult");
surveyResultNode.innerHTML = "";

$.get("{{route('analytics.results', $survey_id)}}", function (data) {
    var visPanel = new SurveyAnalytics.VisualizationPanel(survey.getAllQuestions(), data, {labelTruncateLength: 27});
    visPanel.showHeader = true;

   $('body').toggleClass('loaded');
   $('h1').css('color','#222222');

   

    visPanel.render(surveyResultNode);

    document.title = "Analytics";
});
    </script>

</body>
