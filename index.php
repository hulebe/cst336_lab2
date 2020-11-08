<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>US Quiz</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>     
        <script src = "https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.9.1/underscore-min.js" ></script> 
        <script>
            $(document).ready(function(){
                
                //Global Variables
                var score = 0;
                var attempts = localStorage.getItem("total_attempts");
                
                //event listener
                //"Submit Quiz" button
                $("button").on("click", gradeQuiz);
                
                //Question 5 images
                $(".q5Choice").on("click", function(){
                        $(".q5Choice").css("background","");
                        $(this).css("background","rgb(255, 255, 0)");
                    });
                
                displayQ4choices();
                
                function displayQ4choices() {
                    
                    let q4ChoicesArray = ["Maine", "Rhode Island", "Maryland", "Delaware"];
                    q4ChoicesArray = _.shuffle(q4ChoicesArray);
                    
                    for (let i = 0; i < q4ChoicesArray.length; i++) {
                        $("#q4Choices").append(` <input type="radio" name="q4" 
                            id="${q4ChoicesArray[i]}" value="${q4ChoicesArray[i]}"> <label 
                            for="${q4ChoicesArray[i]}"> ${q4ChoicesArray[i]}</label>`);
                    }
                }//displayQ4Choices
                
                //function
                function isFormValid(){
                    let isValid = true;
                    if ($("#q1").val() == "") {
                        isValid = false;
                        $("#validationFdbk").html("Question 1 was not answered");
                    }
                    return isValid;
                }
                
                function rightAnswer(index) {
                    $(`#q${index}Feedback`).html("Correct!");
                    $(`#q${index}Feedback`).attr("class", "bg-success text-white");
                    $(`#markImg${index}`).html("<img src='img/checkmark.png'>");
                    score += 20;
                }
                
                function wrongAnswer(index) {
                    $(`#q${index}Feedback`).html("Incorrect!");
                    $(`#q${index}Feedback`).attr("class", "bg-warning text-white");
                    $(`#markImg${index}`).html("<img src='img/xmark.png' alt='xmark'>");
                }
                
                function gradeQuiz(){
                    $("#validationFdbk").html(""); //resets validation feedback
                    
                    if (!isFormValid()){
                        return;
                    }
                    
                    //variables
                    let q1Response = $("#q1").val().toLowerCase();
                    let q2Response = $("#q2").val();
                    let q4Response = $("input[name=q4]:checked").val();
                    
                    //Question1 
                    if(q1Response == "sacramento") {
                        rightAnswer(1);
                    }else {
                        wrongAnswer(1);
                    }
                    
                    //Question 2
                    if(q2Response == "mo") {
                       rightAnswer(2);
                    }else {
                        wrongAnswer(2);
                    }
                    
                    //Question 3
                    if ($("#Jefferson").is(":checked") && $("#Roosevelt").is(":checked")
                        && !$("#Jackson").is(":checked") && !$("#Franklin").is(":checked")){
                            rightAnswer(3);
                    }else {
                        wrongAnswer(3);
                    }
                    
                    //Question 4
                    if(q4Response == "Rhode Island") {
                        rightAnswer(4);
                    }else {
                        wrongAnswer(4);
                    }
                    
                    //Question 5
                    if ($("#seal2").css("background-color") == "rgb(255, 255, 0)") {
                        rightAnswer(5);
                    }else {
                        wrongAnswer(5);
                    }
                    $("#totalScore").html(`Total Score: ${score}`);
                    $("#totalAttempts").html(`Total Attempts: ${++attempts}`);
                    localStorage.setItem("total_attempts", attempts);
                }
            
            /*    $("button").on("click", function(){
                    console.log($("#q1").val());
                    //alert($("#q1").val()) //alternative to console.log
                }); //click  */
            }) //ready 
        </script>
    </head>
    <body class="text-center">
        
        <h1 class="jumbotron"> US Geography Quiz</h1>
        
    	<h3><span id="markImg1"></span>What is the capital of California?</h3>
    	<input type="text" id="q1">
    	
    	<div id="q1Feedback"></div>
    	<h3 id="validationFdbk" class="bg-danger text-white"></h3>
	    
	    <div id="q1Feedback"></div>
	    
	    <h3><span id="markImg2"></span>What is the longest river?</h3>
	    <select id="q2">
	        <option value="">Select One</option>
	        <option value="ms">Mississippi</option>
	        <option value="mo">Missouri</option>
	        <option value="co">Colorado</option>
	        <option value="de">Delaware</option>
	    </select>
	    
	    <div id="q2Feedback"></div>
	    
	    <h3 id="validationFdbk" class="bg-danger text-white"></h3>
	    
	    <h3><span id="markImg3"></span>What presidents are carved into mount Rushmore?</h3>
	    <input type="checkbox" id="Jackson"> <label for="Jackson">A.Jackson     </label>
	    <input type="checkbox" id="Franklin"> <label for="Franklin">B. Franklin  </label>
	    <input type="checkbox" id="Jefferson"> <label for="Jefferson">T. Jefferson</label>
	    <input type="checkbox" id="Roosevelt"> <label for="Roosevelt">T. Roosevelt</label>
	    <div id ="q3Feedback"></div>
	    
	    <h3><span id="markImg4"></span>What is the smallest US State?</h3>
	    <div id="q4Choices"></div>
	    <div id="q4Feedback"></div>

        <h3><span id="markImg5"></span>What are the Great Seal of the State of California?</h3>
        <img src="img/seal1.png" alt="Seal 1" class="q5Choice" id="seal1">
        <img src="img/seal2.png" alt="Seal 2" class="q5Choice" id="seal2">
        <img src="img/seal3.png" alt="Seal 3" class="q5Choice" id="seal3">
        <div id = "q5Feedback"></div>
	    <br><br>
	    
	    <button class="btn btn-outline-success"> Submit Quiz </button>
	    <h2 id="totalScore" class="text-info"></h2>
	    
	    <h3 id="totalAttempts"></h3>
    </body>
</html>
