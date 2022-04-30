const BACKEND_URL = 'http://localhost:5000';

$(document).ready(() => {
    if($('#algorithms').val() != 'none'){
        $('#prediction-button').show();
        $('#prediction-button-existent').show();
    }
    else{
        $('#prediction-button').hide();
        $('#prediction-button-existent').hide();
    }

    $('#last-train').ready(() => {
        $.ajax({
            type: 'GET',
            url: BACKEND_URL + '/training/lastTraining',
            beforeSend: (request) => {
                request.setRequestHeader("x-access-token", $('#token').val());
            },
            success : result => {
                $('#last-train-date').text(result);
            },
            error : e => {
                console.log('Request failed: ' +  e);
            }   
        });        
    });

    $('#algorithms').change(() => {
        $.ajax({
            type: 'GET',
            url: BACKEND_URL + '/training/scores',
            beforeSend: (request) => {
                request.setRequestHeader("x-access-token", $('#token').val());
            },
            success : result => {
                let scores = result;

                if($('#algorithms').val() != 'none'){
                    $('#prediction-button').show();
                    $('#prediction-button-existent').show();

                    $('#prediction-accuracy').val((parseFloat(scores[$('#algorithms').val()]['accuracy'])*100).toFixed(2) + '%');

                    $('#prediction-recall-1').val((parseFloat(scores[$('#algorithms').val()]['recall'][0])*100).toFixed(2) + '%');
                    $('#prediction-recall-2').val((parseFloat(scores[$('#algorithms').val()]['recall'][1])*100).toFixed(2) + '%');
                    $('#prediction-recall-3').val((parseFloat(scores[$('#algorithms').val()]['recall'][2])*100).toFixed(2) + '%');

                    $('#prediction-precision-1').val((parseFloat(scores[$('#algorithms').val()]['precision'][0])*100).toFixed(2) + '%');
                    $('#prediction-precision-2').val((parseFloat(scores[$('#algorithms').val()]['precision'][1])*100).toFixed(2) + '%');
                    $('#prediction-precision-3').val((parseFloat(scores[$('#algorithms').val()]['precision'][2])*100).toFixed(2) + '%');

                }
                else{
                    $('#prediction-button').hide();
                    $('#prediction-button-existent').hide();

                    $('#prediction-accuracy').val('0.0%');

                    $('#prediction-accuracy').val(0.0 + '%');

                    $('#prediction-recall-1').val(0.0 + '%');
                    $('#prediction-recall-2').val(0.0 + '%');
                    $('#prediction-recall-3').val(0.0 + '%');

                    $('#prediction-precision-1').val(0.0 + '%');
                    $('#prediction-precision-2').val(0.0 + '%');
                    $('#prediction-precision-3').val(0.0 + '%');

                    $('.prediction-result').val('');
                }
            },

            statusCode:{
                401: () => { 
                    alert('La sesión ha caducado. Vuelva a iniciar sesión.');
                    window.location.href = '../login.php';
                }
            },
            
            error : e => {
                console.log('Request failed: ' +  e);
            }
        });
        
    });

    $('#prediction-button').click(() => {
        let features = [];
        ['N', 'NOTAS', 'FECHACIR', 'FECHAFIN','ETNIA', 'HISTO', 'IPERIN', 'ILINF', 'IVASCU', 'HISTO2', 'ILINF2', 'IVASCU2', 'FALLEC']
        $('.prediction-form-input').each((index, value) => {
            if($(value).attr('id') != 'N' && $(value).attr('id') != 'FECHACIR' && $(value).attr('id') != 'FECHAFIN' && $(value).attr('id') != 'ETNIA' &&
               $(value).attr('id') != 'NOTAS' && $(value).attr('id') != 'RBQ' && $(value).attr('id') != 'TDUPLI.R1' &&
               $(value).attr('id') != 'IPERIN' && $(value).attr('id') != 'ILINF' && $(value).attr('id') != 'TDUPLI.R1' &&
               $(value).attr('id') != 'IVASCU' && $(value).attr('id') != 'ILINF2' && $(value).attr('id') != 'IVASCU2' && $(value).attr('id') != 'FALLEC'
               ){
                features.push($(value).attr('value') == '' ? 0 : $(value).attr('value')*1);
            }
        });
        
        let data = {
            'features': features.toString(),
            'algorithm' : $('#algorithms').val()
        }
        $.ajax({
            type: 'POST',
            url: BACKEND_URL + '/predict',
            data : data,
            beforeSend: (request) => {
                request.setRequestHeader("x-access-token", $('#token').val());
            },

            success : result => {
                $('.prediction-result').val(result);
            },
            error : e => {
                console.log('Request failed: ' + e);
            }
        });
    });

    $('#prediction-button-existent').click(() => {
        let features = [];

        $('.prediction-values-' + $('#selected').val()).each((index, value) => {
            if(
                $(value).attr('id') != 'N' && $(value).attr('id') != 'FECHACIR' && $(value).attr('id') != 'FECHAFIN' && $(value).attr('id') != 'ETNIA' &&
                $(value).attr('id') != 'NOTAS' && $(value).attr('id') != 'RBQ' && $(value).attr('id') != 'TDUPLI.R1' &&
                $(value).attr('id') != 'IPERIN' && $(value).attr('id') != 'ILINF' && $(value).attr('id') != 'TDUPLI.R1' &&
                $(value).attr('id') != 'IVASCU' && $(value).attr('id') != 'ILINF2' && $(value).attr('id') != 'IVASCU2' && $(value).attr('id') != 'FALLEC'
            ){
                features.push($(value).text() == '' ? 0 : $(value).text()*1);
            }
        });
        
        let data = {
            'features': features.toString(),
            'algorithm' : $('#algorithms').val()
        }
        $.ajax({
            type: 'POST',
            url: BACKEND_URL + '/predict',
            data : data,
            beforeSend: (request) => {
                request.setRequestHeader("x-access-token", $('#token').val());
            },

            success : result => {
                $('.prediction-result').val(result);
                $('.prediction-result-input').val(result);
            },
            error : e => {
                console.log('Request failed: ' + e);
            }
        });
    });
});

function select(event){
    let id = event.id 
    $('#selected').val(id);
    $('.modal-title').text('Predecir sobre el paciente #' + id);
    $('.prediction-result').val('');
    $('.prediction-result-input').val('');
}