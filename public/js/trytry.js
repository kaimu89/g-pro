$(function () {

    // var obj = {
    //     name: '太郎',
    //     age: 30,
    //     area: 'Tokyo'
    // }

    // var json = JSON.stringify(obj);

    // var url = 'data/json.json';

    // $.ajax({
    //     type: 'GET',
    //     url: url,
    //     data: JSON.stringify(json),
    //     contentType: 'application/json',
    //     dataType: 'JSON',
    //     scriptCharset: 'utf-8',
    //     success: function (data) {

    //         // Success
    //         alert("success");
    //         alert(JSON.stringify(data));
    //     },
    //     error: function (data) {

    //         // Error
    //         alert("error");
    //         alert(JSON.stringify(data));
    //     }
    // });

});



var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

// function hello(value) {
//     $('.hello').html(`<div>${value}</div>`);
// }

// $('.hello').on('click', function () {

//     axios({
//         method: 'POST',
//         url: '/try',
//         params: {
//             _token: CSRF_TOKEN,
//             team_id: 1,
//         }
//     }).then(function (response) {
//         console.log(response.data.length)

//         hello(response.data.length)

//     }).catch(function (err) {
//         console.log(err)
//     })
// })

const fire = axios({
    method: 'GET',
    url: '/jsontry',
    params:{
        _token: CSRF_TOKEN,
    }
})

console.log(fire)

async function respect(){
    const bell = await axios.get('/jsontry');

    console.log(bell.data)
}

respect()



function goodnight(value) {
    $('.goodnight').html(`<div>${value}</div>`);
}


axios({
    method: 'GET',
    url: '/jsontry',
}).then(function (response) {

    let count = response.data.notices.length

    console.log(count)

    $('.goodnight').on('click', function () {

        count++;

        goodnight(count);

        axios({
            method: 'POST',
            url: '/try',
            params: {
                _token: CSRF_TOKEN,
                team_id: 1,
            }
        }).catch(function (err) {
            console.log(err)
        })
    })
})


