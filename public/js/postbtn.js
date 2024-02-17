function addPost(){
                'use strict'
                if(confirm('投稿すると投稿一覧に表示されます。\n本当に投稿しますか？')){
                    document.getElementById('form_post').submit();
                }
            }
            
function editPost(id){
                'use strict'
                if(confirm('編集すると変更内容が投稿に反映されます。\n本当に変更しますか？')){
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