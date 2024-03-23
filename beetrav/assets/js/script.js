const categ_ru = document.querySelector('[name="categ_ru"]');
const btn = document.querySelector('[name="btn"]');
const dati = document.querySelector('#datdi');
const rech = document.querySelector('[name="rech"]');

const ajout = document.querySelector('#ajout');
const cadd = document.querySelector('.cadd');
const btn2 = document.querySelector('#btnaddru');
const plus = document.querySelector('#plus');
const moins = document.querySelector('#moins');
const categ_re = document.querySelector('[name="categ_re"]');
const dats = document.querySelector('[name="dats"]');
const reco = document.querySelector('[name="reco"]');
const cadd3 = document.querySelector('#cadd3');
const btn3 = document.querySelector('#btnaddre');
const plus3 = document.querySelector('#plus3');
const moins3 = document.querySelector('#moins3');
const supp = document.querySelectorAll('.supp');
const acess = document.querySelector('.acess');

window.addEventListener('DOMContentLoaded',function(){
    let option = (categ_ru.value);
    if(option=="date_installation_ru"){
        dati.classList.remove('hide');
        rech.classList.add('hide');
    }
    else{
        dati.classList.add('hide');
        rech.classList.remove('hide');
    };
    let optionv2 = (categ_re.value);
    if((categ_re.value)=="date_re"){
        dats.classList.remove('hide');
        reco.classList.add('hide');
    }
    else{
        dats.classList.add('hide');
        reco.classList.remove('hide');
    }
});
categ_re.addEventListener('click',function(){
    if((categ_re.value)=="date_re"){
        dats.classList.remove('hide');
        reco.classList.add('hide');
    }
    else{
        dats.classList.add('hide');
        reco.classList.remove('hide');
    }
})
categ_ru.addEventListener('click',function(){
    let option = (categ_ru.value);
    if(option=="date_installation_ru"){
        dati.classList.remove('hide');
        rech.classList.add('hide');
    }
    else{
        dati.classList.add('hide');
        rech.classList.remove('hide');
        };
});

btn2.addEventListener('click',function(){
    if(moins.classList=='hide'){
        cadd.classList.remove('hide');
    }
    else {
        cadd.classList.add('hide');
    }
    plus.classList.toggle('hide');
    moins.classList.toggle('hide');
    
});
btn3.addEventListener('click',function(){
    if(moins3.classList=='hide'){
        cadd3.classList.remove('hide');
    }
    else {
        cadd3.classList.add('hide');
    }
    plus3.classList.toggle('hide');
    moins3.classList.toggle('hide');
    
});
supp.forEach(bouton => { bouton.addEventListener("click", function(event) {
    if ( confirm("Confirmez-vous la suppression de cette information ?") == false ){
    // si annuler, alors stopper le traitement par défaut du lien ( la redirection est annulée)
    event.preventDefault();
    }}
    );});
acess.addEventListener("click", function(event){
    if ( confirm("Voulez vous changer le mode accessible?") == false ){
        // si annuler, alors stopper le traitement par défaut du lien ( la redirection est annulée)
        event.preventDefault();
        }}
        );;
//---------------------------------------------------------------
const pruche = document.querySelector('#pruche');
const precolte = document.querySelector('#precolte');
const pparametre = document.querySelector('#pparametre');
const divruche = document.querySelectorAll('.ruches');
const divrecolte = document.querySelectorAll('.recoltes');
const divparametre = document.querySelector('.parametre');
const page = document.querySelectorAll('[name="page"]');

page.forEach(pagette => pagette.addEventListener('click',function(){
    pruche.addEventListener('click',function(){
        divruche.forEach(ruchette => ruchette.classList.remove('hide'));
        divrecolte.forEach(recoltette => recoltette.classList.add('hide'));
        divparametre.classList.add('hide');
        pass=1;
    })
    precolte.addEventListener('click',function(){
        divruche.forEach(ruchette => ruchette.classList.add('hide'));
        divrecolte.forEach(recoltette => recoltette.classList.remove('hide'));
        divparametre.classList.add('hide');
        pass=2;
    })
    pparametre.addEventListener('click',function(){
        divruche.forEach(ruchette => ruchette.classList.add('hide'));
        divrecolte.forEach(recoltette => recoltette.classList.add('hide'));
        divparametre.classList.remove('hide');
        pass=3;
    })
}))
