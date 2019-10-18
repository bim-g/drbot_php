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
function getId(id,src){            
    var myobject={
        "id_elem":id,
        "src":src,
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
function activatemenu(){
    var link=window.location.pathname;
    link=link.replace("/drbot_client/pages/","");        
    var pos =/.php/.exec(link);
    link =link.slice(0,pos.index);
    document.cookie=`activemenu=${link}`;
}