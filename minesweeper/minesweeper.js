var randomArray;
var tcal;
$('#difficulty').change(function(){
    // alert($('#difficulty').val());
    switch($('#difficulty').val()) {
        case 'easy':
            // alert("activate!");
            $('#bombNum').val(10);
            break;
        case 'medium':
            $('#bombNum').val(40);
            break;
        case 'hard':
            $('#bombNum').val(99);
            break;
        default:
            $('#bombNum').val(0);
    }
})
//generate click
$('#gene').click(function(){
    switch($('#difficulty').val()) {
        case 'easy':
            generate(8,8);
            break;
        case 'medium':
            generate(16,16);
            break;
        case 'hard':
            generate(30,16);
            break;
        default:
            alert("Choose a Difficulty!");
    }
    canPlay(true);
    timecal();
})
//generate section

function generate(row, col){
    $("#time").TimeCircles().restart();
    $('#bombLeft').html('<span>Left: '+ $('#bombNum').val() + ' bombs!</span>');
    geneForm(row, col);
    geneRandom(row, col, $('#bombNum').val());

    $('#gamePlace span').css({
        "height":"80%",
        "left":"25%",
        "transform":"translateX(-50%) translateY(-50%)"});
    $('#gamePlace img').css({
        "height":"80%",
        "left":"50%",
        "top":"40%",
        "transform":"translateX(-50%) translateY(-50%)"
    });
    $('#gamePlace img').hide();
}

function geneForm(row, col){
    var wid = row*40;
    var hei = col*40;
    var formHTML = "<table border='1' width= '"+ wid + "' height='" + hei + "'>"
    randomArray = new Array(col);

    for(i=0; i<col; i++){
        formHTML += "<tr>";
        randomArray[i] = new Array(row);
        for(j=0; j<row; j++){
            formHTML +="<td id=" + i + "y" + j + " width='30' height='30' valign='center'><img class='number' src='https://cdn3.iconfinder.com/data/icons/math-physics/512/null-512.png'></img><img class='flag' src='data:image/png;base64,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'></img></td>";
            randomArray[i][j] = 0;
        }
        formHTML += "</tr>";
    }
    formHTML += "</table>";
    $('#gamePlace').html(formHTML);
}

function geneRandom(row, col, bombNum){
    // console.log('geneRandom is activated!');
    var alreadyBombNum = 0;
    
    while(alreadyBombNum < bombNum){
        // var r = Math.floor(Math.random() * row * col) + 1;
        // if(randomArray.indexOf(r) === -1) randomArray.push(r); //avoid duplicate num generated
        
        var rCol = Math.floor(Math.random() * col);
        var rRow = Math.floor(Math.random() * row);
        if(randomArray[rCol][rRow] < 99) {
            randomArray[rCol][rRow] = 99;
            alreadyBombNum++;

            //add bomb image
            $('#' + rCol + 'y' + rRow).html('<img src="https://image.winudf.com/v2/image1/ZG9scGhpbi5hbmRyb2lkLmFwcHMubWluZXN3ZWVwZXJfaWNvbl8xNTc2ODQ1NTEwXzA1MA/icon.png?w=170&fakeurl=1"></img>');
            // $('#' + rCol + 'y' + rRow).html('<span>'+ randomArray[rCol][rRow] +'</span>');

            

            //cal td number
            for(var i = (rCol - 1); i < (rCol + 2); i++) {
                if(i >= 0 && i < col) {
                    for(var j = (rRow - 1); j < (rRow +2); j++) {
                        if(j >= 0 && j < row){
                            if(i != rCol || j != rRow) {
                                if(randomArray[i][j] !== 99) {
                                    randomArray[i][j] = randomArray[i][j] +1;
                                    // $('#' + i + 'y' + j).html('<span>' + randomArray[i][j] + '</span>');         
                                    
                                    for(var k = 1;k < 9;k++){
                                        if(randomArray[i][j]==k){
                                            $('#' + i + 'y' + j).html('<img class="number" src="https://gamedata.britishcouncil.org/sites/default/files/attachment/number-' + k + '_1.jpg"></img>');
                                        }
                                    }
                                }
                            }
                        }                    
                    }
                }
            }
        }
     }
    console.log(randomArray);
}

//game section
function canPlay(canflag) {
    var bombNum = $('#bombNum').val();
    var corNum = 0;
    if(canflag) {

        //left click

        $('#gamePlace').on("click", "td", function(event){
            var pos = this.id.split('y');
            
            if(randomArray[pos[0]][pos[1]] == 99) { //end 
                $('#gamePlace img').show();
                $('#gamePlace .flag').hide();
                canPlay(false);
                // clearInterval(tcal);
                $("#time").TimeCircles().stop();
                alert('Bomb!');
            }else{
                $(this).find('img').show();
                $(this).find('.flag').hide();
            }
            //$(this).show();
        });

        // right click
        $('#gamePlace').on("contextmenu", "td",function(event){
            var pos = this.id.split('y');

            // alert('right click activate!');
            if(!$(this).find('.number').is(':visible')){
                //check flag exist
                if($(this).find('.flag').length <= 0) {
                    $(this).append('<img class="flag" src="data:image/png;base64,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"></img>');
                }else {
                    $(this).find('.flag').toggle();
                }
                //check flag visible
                if($(this).find('.flag').is(':visible')){
                    bombNum = bombNum - 1;
                }else{
                    bombNum = bombNum + 1;
                }
                //check correct
                if(randomArray[pos[0]][pos[1]] == 99) {
                    corNum = corNum + 1;
                }
                //end game
                if( corNum == $('#bombNum').val() && bombNum == 0){
                    canPlay(false);
                    alert('You Win');
                    $("#time").TimeCircles().stop();
                }
                // reduce left bomb number
                $('#bombLeft').html('<span>Left: '+ bombNum + ' bombs!</span>'); 
                $('#gamePlace img').css({
                    "height":"80%",
                    "left":"50%",
                    "top":"40%",
                    "transform":"translateX(-50%) translateY(-50%)"
                });
            }
            return false;
        })
    } else {
        $('#gamePlace').off("click", "td");
        $('#gamePlace').off("contextmenu", "td");
    }
}

function timecal(){
    var sec = 0;
    var date = new Date().toLocaleString();
    $('#time').attr("data-date", date);
    $('#time').TimeCircles();

    // tcal = setInterval(function () {
    //             sec = sec + 1;
    //             if (sec>60){
    //                 var min = sec/60;
    //                 var show_sec = sec%60;
    //             }else{min = 0;show_sec = sec;}
    //             $('#time').html('<span>'+ min + ' : ' + show_sec + '</span>');
    //         }, 1000);
}
