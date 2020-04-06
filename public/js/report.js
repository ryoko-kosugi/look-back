$(function(){

    $('.week a').on('click', e => {
        // e.preventDefault();
        let id = $(e.currentTarget).parent().attr('id'); //クリックされた日付文字列 2020-03-09 00:00:00
      
        let array_ids = getReadIds();
       
        array_ids.push(id); // pushメソッドの返り値は配列の数を返すので返り値を保つ必要がない
        
        // 配列要素の重複を取り除く アロー関数式
        array_ids = array_ids.filter((x, i, self) => self.indexOf(x) === i);
        
        sessionStorage.setItem('monday', array_ids); //sessionStorageで保存
        console.log(array_ids);
    });
    
    //配列を作成
     function getReadIds(){
        let saved_id = sessionStorage.getItem('monday'); //sessionStorageに現在保存されている値を取得
        let array_id = new Array(); //空の配列を作成
        
        if(saved_id) { //クリックされて保存されている値があれば
            array_id = saved_id.split(","); //,の部分で区切って配列にする
        } 
        let array_ids = array_id; 
        $('.week a').each((index, saved_id) => { 
            let selected = $(saved_id).parent().attr('id'); //クリックされた日付リストのid
    
            if(array_ids.includes(selected)){
                $(saved_id).addClass('read');
            }
        }); 
        return array_ids;
    }
    
});


