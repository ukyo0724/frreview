function addPost(number){
            if(number==2){
                document.getElementById('status').value = 2;
                'use strict'
                if(confirm('投稿すると投稿一覧に表示されます。\n本当に投稿しますか？')){
                    document.getElementById('form_post').submit();
                }
                    
            }else{
                'use strict'
                if(confirm('下書きをすると下書きデータに保存されます。\n本当に投稿しますか？')){
                    document.getElementById('form_post').submit();
                }
            }
            }
            
function editPost(number){
                if(number==2){
                document.getElementById('status').value = 2;
                'use strict'
                if(confirm('投稿すると投稿一覧に表示されます。\n本当に投稿しますか？')){
                    document.getElementById('form_edit').submit();
                }
                    
            }else{
                'use strict'
                if(confirm('下書きをすると下書きデータに保存されます。\n本当に投稿しますか？')){
                    document.getElementById('form_edit').submit();
                }
            }
            }
            
function editDraft(id){
                'use strict'
                if(confirm('下書きをすると下書きデータに保存されます。\n本当に投稿しますか？')){
                    document.getElementById(`form_edit_${id}`).submit();
                }
            }
            
function deletePost(id){
                'use strict'
                
                if(confirm('削除すると復元できません。\n本当に削除しますか？')){
                    document.getElementById(`form_${id}`).submit();
                }
            }
function addComment(id){
                'use strict'
                if(confirm('コメンをを投稿すると投稿にコメントが表示されます。\n本当に投稿しますか？')){
                    document.getElementById(`form_comment_${id}`).submit();
                }
            }
function imageDelete(id){
                'use strict'
                if(confirm('選択された写真を削除し復元することはできません。\n本当に削除しますか？')){
                    document.getElementById(`form_image_delete_${id}`).submit();
                }
}
        

 function main(){
     const input = document.querySelector('#input');
     const figure=document.querySelector('#figure');
     const figureImage=document.querySelector('#figureImage');
     
     input.addEventListener('change', (event)=>{
         const [file]=event.target.files
         
         if(file){
             figureImage.setAttribute('src', URL.createObjectURL(file))
             figure.style.display='black'
         }else{
             figure.style.display='none'
         }
         })
     }
 