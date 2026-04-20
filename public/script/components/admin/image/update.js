
//Variable img_content(Bloc contenant les images uploadees)
let img_content=document.querySelectorAll('div[id="img_content"]')[0];
//Variable formulaire
let form=document.querySelectorAll('form[id="register_evenement_form"]')[0];

function createImgItem(imgURL){
    var imgItem=document.createElement('div');
    imgItem.setAttribute('id','img_item');
    const isVideo=function(imgURL){
        if(imgURL.includes('data:video') || imgURL.endsWith('.mp4') || imgURL.endsWith('.MP4') || imgURL.endsWith('.avi') || imgURL.endsWith('.AVI') || imgURL.endsWith('.flv') || imgURL.endsWith('.FLV') || imgURL.endsWith('.mpg') || imgURL.endsWith('.MPG') || imgURL.endsWith('.mpeg') || imgURL.endsWith('.MPEG') || imgURL.endsWith('.wmv') || imgURL.endsWith('.WMV') || imgURL.endsWith('.vob') || imgURL.endsWith('.VOB') || imgURL.endsWith('.mov') || imgURL.endsWith('.MOV') || imgURL.endsWith('.AVCHD') || imgURL.endsWith('.avchd') || imgURL.endsWith('.WebM')) {
            return true;   
        } else {
            return false;
        }
    } 

    //Initialize le content
    var content= isVideo(imgURL) ? '<video controls class="cover" style="width: 100%;height: 100%;"><source src="'+imgURL+'" id="img_data_url"></video>' : '<img src="'+imgURL+'" class="rounded-thumbnail cover" id="img_data_url" style="width: 100%;height: 100%;"/>';
    //Creer le content
    var itemContent='<div id="img_item_content">'+
        '<div id="img_bloc">'+
           '<div class="card">'+
                '<div class="card-body">'+
                    ''+content+''
                +'</div>'
           +'</div>'
        +'</div>'+
        '<div id="close_bloc">'+
            '<button type="button" title="Annuler l\'image" class="btn btn-danger btn-sm">'+
               '<i class="fa fa-times"></i>'
            +'</button>' 
        +'</div>'
    +'</div>';

    //Ajout Contenu
    imgItem.innerHTML=itemContent;
    
    //renvoie le nouveau element creer
    return imgItem;
}


function createInputItem(file) {
    //Creer input
    var input=document.createElement('input');
    //Attribue et style
    input.setAttribute('type','file');
    input.setAttribute('name','imgs[]');
    input.setAttribute('id','imgs');
    input.style.display='none';
    input.value=file;
    //Renvoie le nouveau element creer
    return input;
}

/******
 * Supprime une image existante 
 * *****/
function removeExistedImage(img_to_removed) {
    //Creer input image existant
    var remove_existed_files_input=document.createElement('input');
    //Attribut & valeur
    remove_existed_files_input.setAttribute('type','hidden');
    remove_existed_files_input.setAttribute('name','remove_existed_files[]');
    remove_existed_files_input.setAttribute('id','remove_existed_files');
    remove_existed_files_input.value=img_to_removed;
    //Ajoute nouveau element cree au formulaire  
    document.querySelectorAll('form')[0].prepend(remove_existed_files_input); 
}

/************
 * Supprime une image uploade
 *  ***********/
function removeUplodedImage(file_to_remove){
    //Creer le nouveau element input
    var remove_uploaded_files_input=document.createElement('input');
    //Modifie attributs & valeur
    remove_uploaded_files_input.setAttribute('type','hidden');
    remove_uploaded_files_input.setAttribute('name','remove_uploaded_files[]');
    remove_uploaded_files_input.setAttribute('id','remove_uploaded_files');
    remove_uploaded_files_input.value=file_to_remove.name;
    //Ajoute nouveau element cree au formulaire  
    document.querySelectorAll('form')[0].prepend(remove_uploaded_files_input); 
}


document.querySelectorAll('input[id="images"]')[0].onchange=function(e){
    //Initialize la valeur total & loaded pour l'upload des fichiers
    var total=0;
    var loaded=0;
    var pourcent=0;
    //Affiche la bar de progression
    document.querySelectorAll('div[id="images_progress"]')[0].style.display='block';
    //Convertir l'object en tableau de fichier
    var fileArray=Object.values(e.target.files);
    //Parcourt l'ensemble de fichier
    fileArray.forEach(file=>{
        var fileReader=new FileReader();
        fileReader.onload=function(e){
            //Creer une image et l'ajoute dans le bloc image
            img_content.append(createImgItem(e.target.result));                                 
        }
        //Au moment de la progression du fichier  
        fileReader.onprogress=function(e) {
            if(e.lengthComputable) {
                loaded=loaded+e.loaded;
                total=total+file.size;
                var progressbar=document.querySelectorAll('div[id="progressbar"]')[0];
              
                pourcent=Math.round(loaded*100/total);
                if(pourcent<=100){
                    progressbar.style.width=''+pourcent+'%';
                    progressbar.innerText=''+pourcent+'%';
                }
            }
        }
        fileReader.readAsDataURL(file);
        setInterval(function(){
           if(pourcent) {
                if(pourcent==100){        
                    //Cache la bar de progression
                    setInterval(function(){
                        document.querySelectorAll('div[class="progress"]')[0].style.display='none';
                    },1100);
                    //Cache le popup
                    setTimeout(function(){
                        document.querySelectorAll('button[class="btn-close"]')[0].click();
                    },2400);
                    //Renvoie a la valeur initiale
                    setTimeout(function(){
                        pourcent=0;
                    },2500);
                }
           }
        },100);
    });
    
    // setInterval(function(){
    //     alert('Mousse');
    // },100);
}



setInterval(function(){
    //Bloc engolbant les buttons d'action
    var action_image_buttons=document.querySelectorAll('div[id="action_image_buttons"]')[0];
    //L'element popup affichant les images
    var evenement_image_popup=document.querySelectorAll('div[id="evenement_image_popup"]')[0];
    //Remove button
    var remove_btn=document.querySelectorAll('button[id="remove_btn"]')[0];
    //Block close
    var close_blocs=document.querySelectorAll('div[id="close_bloc"]');
    //Du moment ou le modal s'affiche
    var img_items=document.querySelectorAll('div[id="img_item"]');
    //Au moment le popup(modal) est visible
    evenement_image_popup.addEventListener('show.bs.modal',function(){
        action_image_buttons.style.display='block'; 
    });
    //Du moment ou le modal s'affiche pas
    evenement_image_popup.addEventListener('hide.bs.modal',function(){
        action_image_buttons.style.display='none'; 
    });
    //Au moment ou on click sur le button remove_btn
    remove_btn.onclick=function(){
        document.querySelectorAll('div[id="close_bloc"]').forEach(element => {
            if(element.style.display!='block') {
                element.style.display='block';
                this.innerHTML='<i class="fa fa-times"></i>'
            } else {
                element.style.display='none';
                this.innerHTML='<i class="fa fa-minus"></i>'
            } 
        });
        // //Ajout style au bloc img_item
        // img_items.forEach(function(element){
        //     element.style.marginTop='20px';
        // });
    }
    //Au moment aou on clic sur le button contenu dans le bloc
    close_blocs.forEach(function(element,index){
        element.querySelector('button').onclick=function(){
            //Recupere l'URL de l'image
            let img_data_url=document.querySelectorAll('#img_data_url')[index].getAttribute('src');
            //En cas presence de l'image
            if(images) {
                //Image a supprimer
                const img_to_removed=images.find(function(item){
                    return window.STORAGE_PATH_URL+'/'+item.path==img_data_url;
                });
                //Image existed
                if(img_to_removed) {
                    removeExistedImage(img_to_removed.path);
                }else {
                    //Initialize la variable fileIndex
                    var fileIndex=0;
                    //Ensemble de fichiers
                    const files=document.querySelectorAll('input[id="images"]')[0].files;
                    //Parcourt l'ensemble de fichiers
                    for(let i=0;i<files.length;i++) {
                        if(files[i].name=img_data_url) {
                            fileIndex=i;
                        }
                    }
                    //Appel a la methode
                    removeUplodedImage(files[fileIndex]);
                }
            } 
            else {
                //Appel a la methode
                removeUplodedImage(document.querySelectorAll('input[id="images"]')[0].files[fileIndex]);
            }         
            //Supprime l'element
            img_items[index].remove();
        }
    });
},600)


/*** Au moment de chargement complete de la page ***/
document.onreadystatechange=function(){
    if(document.readyState.toLowerCase()=='complete') {
        //Parcourt les images
        images.forEach(item=>{
            img_content.append(createImgItem(window.STORAGE_PATH_URL+'/'+item.path));
        });  
    }
}

images.forEach(item=>{
    img_content.append(createImgItem(window.STORAGE_PATH_URL+'/'+item.path));
});  
