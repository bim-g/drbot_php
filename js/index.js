w3.show('#errorModal');
w3.show(' #succesModal');
w3.show(' #warning');
_();
function changeCadre(val){
    _();
    w3.removeClass("."+val,'w3-hide')
}
function _(){
    w3.addClass('.controlHide','w3-hide');
}
function managTopicName(id){
    w3.addClass(".topicStatus",'w3-hide');
    if(id){
        w3.removeClass(id,"w3-hide ");
    }
} 
function gotopages(link=null,destination) {
    let url=window.location.origin+"/drbot_client/";
    let target="pages/"+link;
    if(destination && destination==1 ){
        target="controller/"+link;
    }
    url+=target;
    window.location.href=url;
}
function getData(id,src,operation){
    let link="?"+operation+"="+id;
    var myobject = {
        "itElement": id,
        "src": src,
        "target": src + ".php" + link
    };
    w3.getHttpObject(displaymyData);
}

function displaymyData(myObject) {
    console.log(myObject);
    //w3.displayObject("formData",myObject);
}
function getId(id,src){ 
    let question=null;
    switch(src){
        case "training":question="Do you want to delete this topic?";
        break;
        case "deleteTopic": question = "Do you want to delete this topic?";
        break;
    }
    var myobject={
        "id_elem":id,
        "message":question,
        "src": src,
        "target":src+".php"
        };
    w3.displayObject("deleteQ",myobject);    
}
function showMessage(id,name,email,objt,content){            
    var myobject={
        "idmessage":id,
        "namesender":name,
        "emailsender":email,
        "objtmsg":objt,
        "contentmsg":content
        };
        w3.displayObject("readmsg",myobject);
        w3.displayObject("respondmsg",myobject);

}
(function(){
    var link = window.location.pathname;
    link = link.replace("/drbot_client/pages/", "");
    var pos = /.php/.exec(link);
    link = link.slice(0, pos.index);
    document.cookie = `activemenu=${link}`;
})();
function activatemenu(){
    // var link=window.location.pathname;
    // link=link.replace("/drbot_client/pages/","");        
    // var pos =/.php/.exec(link);
    // link =link.slice(0,pos.index);
    // document.cookie=`activemenu=${link}`;
}