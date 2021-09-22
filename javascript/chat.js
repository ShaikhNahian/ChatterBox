const form = document.querySelector(".typing-area"),
uploadMedia = document.getElementById("uploadMedia"),
fileToUpload = document.getElementById("fileToUpload"),

// const ,
incoming_id = form.querySelector(".incoming_id").value,

inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("button"),
media_button=document.getElementById("media_button"),
chatBox = document.querySelector(".chat-box");

form.onsubmit = (e)=>{
    e.preventDefault();
}
uploadMedia.onsubmit = (e)=>{
    e.preventDefault();
}


inputField.focus();
inputField.onkeyup = ()=>{
    if(inputField.value != ""){
        sendBtn.classList.add("active");
    }else{
        sendBtn.classList.remove("active");
    }
}

sendBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "master/php/insert-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              inputField.value = "";
              scrollToBottom();
          }
      }
    }
    let formData = new FormData(form);
        xhr.send(formData);
}
media_button.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    // console.log(fileToUpload.value);
    //console.log(xhr);
    xhr.open("POST", "master/upload.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            fileToUpload.value="";
              scrollToBottom();
          }
      }
    }
    let formData = new FormData(uploadMedia);
    console.log(uploadMedia);
    xhr.send(formData);
}
chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}

chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}

setInterval(() =>{
    let xhr = new XMLHttpRequest();
   // console.log(xhr);
    xhr.open("POST", "master/php/get-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response;
            chatBox.innerHTML = data;
            if(!chatBox.classList.contains("active")){
                console.log()
                scrollToBottom();
              }
          }
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("incoming_id="+incoming_id);
}, 500);

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
  }
  
