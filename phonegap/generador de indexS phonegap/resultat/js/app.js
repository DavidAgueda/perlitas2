/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//$("#pageone").css('background-color', localStorage.color);


var categorys = [
    {'id': '01', 'name': 'Moviles', img: 'imgCa1.png'},
    {'id': '02', 'name': 'Ordenadores', img: 'imgCa2.png'},
    {'id': '03', 'name': 'Portatiles', img: 'imgCa3.png'}
];
var produits = {
'1':[
    {'id': '01', 'name': 'Motorola G', img: 'img1Pro1.png', 'description': 'Motorola G'},
    {'id': '02', 'name': 'Motorola M', img: 'img1Pro2.png', 'description': 'Motorola M'},
    {'id': '03', 'name': 'Motorola X', img: 'img1Pro3.png', 'description': 'Motorola X'},
    {'id': '04', 'name': 'Samsung S5', img: 'img1Pro4.png', 'description': 'Motorola G'}
],
'2':[
    {'id': '01', 'name': 'Asus VS228NE Ecran LED 22"', img: 'img2Pro1.png', 'description': 'Asus VS228NE Ecran LED 22"'}
],
'3':[
    {'id': '01', 'name': 'Asus VS228NE Ecran LED 22"', img: 'img3Pro1.png', 'description': 'Asus VS228NE Ecran LED 22"'}
]

};

$().ready(function () {
    categorys.forEach(function (category) {
        var div = $('<div />');
        div.addClass('categorys');
        //div.html(category.name);
        
        var a = $('<a />');
        a.attr('onclick', 'loadP3('+category.id+')');
        a.attr('href', '#pageThree');
        
        var img = $('<img />');
        img.addClass('imgCategory');
        img.attr('src','img/category/'+ category.img );
        
        var h2 = $('<h2 />');
        h2.addClass('center');
        h2.addClass('h2Category');
        h2.html(category.name);
        
        a.append(h2);
        a.append(img);
        div.append(a);
        
        $('#mainPageTwo').append(div);
        console.log(category);
    });
    
   // $('a[href^="#pagetwo"]').click(AnimationP2());
})

$('a[href^="#pagetwo"]').click(AnimationP2);

function AnimationP2(){
    $('.h2Category').animate({
                bottom : "-10px"
    },1500);
    $('.h2Category').animate({
                bottom : "20px"
    },500);
    $('.h2Category').animate({
                bottom : "00px"
    },500);
    
    $('.imgCategory').animate({
                position:'none',
                right: '0px'
               // right:'relative',
    },1500)
}

function loadP3(idCategory){
    //$('#mainPageThree').html(produits);
    console.log(produits[idCategory]);
    
    $('#mainPageThree').html('');
    
    produits[idCategory].forEach(function(produit){
        
        var div = $('<div />');
        div.addClass('produits');
        //div.html(category.name);
        
        var a = $('<a />');
        a.attr('onclick', 'loadP4('+produit.id+')');
        a.attr('href', '#pageThree');
        
        var img = $('<img />');
        img.addClass('imgProduit');
        img.attr('src','img/produit/'+ produit.img );
        
        var h2 = $('<h2 />');
        h2.addClass('center');
        h2.addClass('h2Produit');
        h2.html(produit.name);
        
        a.append(h2);
        a.append(img);
        div.append(a);
        
        $('#mainPageThree').append(div);
        

    });
}