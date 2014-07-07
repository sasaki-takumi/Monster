<?php
    $url = "http://www31092u.sakura.ne.jp/~g031k068/g031k068/cake2/monsters/locationinfo";//コールバック
?>

<script type="text/javascript">
    navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
    function successCallback(position) {    /* 成功時の処理 */
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;
        if(latitude){   /* 変数latitudeに値が入ってた時 */
            location.href = "<?php echo $url; ?>?lati=" + latitude + "&long=" + longitude + "&map=https://maps.google.com/maps?q=" + latitude + "," + longitude + "&location=<?php echo $data['Monsteruser']['location']; ?>" + "&id=<?php echo $data['Monsteruser']['id']; ?>";
        }
    }
    function errorCallback(error) { /* 失敗時の処理 */
        location.href = "<?php echo $url; ?>?alart=on";
    }
</script>

<?php
    if(isset($_GET['lati'])) {
        echo '緯度：'.$_GET['lati'].'<br />';
        echo '経度：'.$_GET['long'].'<br />';
        echo "位置情報の取得に成功しました！".'<br />';

        //遠野
        if($_GET['location'] == 'tono') {
            if($_GET['lati'] < 100) {//テスト用
            // if(($_GET['lati'] > 141.360973) && ($_GET['lati'] < 141.704295) &&
            //    ($_GET['long'] > 39.188635) && ($_GET['long'] < 39.45423)) {
                echo 'ようこそ遠野市へ.'.'<br />'.'河童をゲットしたよ！';

                echo $this->Form->create('Monsteruser', array('url' => 'saveimg'));
                echo $this->Form->hidden('tono',array('value' => 'kappa_tono.png'));//idをhiddenで取得
                echo $this->Form->hidden('id',array('value' => $_GET['id']));//idをhiddenで取得
                echo $this->Form->end('戻る');    
            }else {
                echo "位置情報が違います.遠野市に行きましょう！";
                echo $this->Html->link('戻る',array('action' => 'tono'));
            }
         //雫石
        }else if($_GET['location'] == 'sizukuishi') {
            if($_GET['lati'] < 100) {//テスト用
            // if(($_GET['lati'] > 140.797264) && ($_GET['lati'] < 141.140587) &&
            //    ($_GET['long'] > 39.572339) && ($_GET['long'] < 39.836474)) {
                echo 'ようこそ雫石町へ.'.'<br />'.'うなぎ男をゲットしたよ！';

                echo $this->Form->create('Monsteruser', array('url' => 'saveimg'));
                echo $this->Form->hidden('sizukuishi',array('value' => 'unagiotoko_sizukuisi.png'));//idをhiddenで取得
                echo $this->Form->hidden('id',array('value' => $_GET['id']));//idをhiddenで取得
                echo $this->Form->end('戻る');    
            }else {
                echo "位置情報が違います.雫石町に行きましょう！";
                echo $this->Html->link('戻る',array('action' => 'sizukuishi'));
            }
        //盛岡
        }else if($_GET['location'] == 'morioka') {
             if($_GET['lati'] < 100) {//テスト用
            // if(($_GET['lati'] > 140.979225) && ($_GET['lati'] < 141.322548) &&
            //    ($_GET['long'] > 39.570211) && ($_GET['long'] < 39.834365)) {
                echo 'ようこそ盛岡市へ.'.'<br />'.'羅刹鬼をゲットしたよ！';

                echo $this->Form->create('Monsteruser', array('url' => 'saveimg'));
                echo $this->Form->hidden('morioka',array('value' => 'rasetuki_morioka.png'));//idをhiddenで取得
                echo $this->Form->hidden('id',array('value' => $_GET['id']));//idをhiddenで取得
                echo $this->Form->end('戻る');    
            }else {
                echo "位置情報が違います.盛岡市に行きましょう！";
                echo $this->Html->link('戻る',array('action' => 'morioka'));
            }
        //宮古
        }else if($_GET['location'] == 'miyako') {
            if($_GET['lati'] < 100) {//テスト用
            // if(($_GET['lati'] > 141.788793) && ($_GET['lati'] < 142.132115) &&
            //    ($_GET['long'] > 39.515143) && ($_GET['long'] < 39.779497)) {
                echo 'ようこそ宮古市へ.'.'<br />'.'枕返しをゲットしたよ！';

                echo $this->Form->create('Monsteruser', array('url' => 'saveimg'));
                echo $this->Form->hidden('miyako',array('value' => 'makuragaesi_miyako.png'));//idをhiddenで取得
                echo $this->Form->hidden('id',array('value' => $_GET['id']));//idをhiddenで取得
                echo $this->Form->end('戻る');    
            }else {
                echo "位置情報が違います.宮古市に行きましょう！";
                echo $this->Html->link('戻る',array('action' => 'miyako'));
            }
        //北上
        }else if($_GET['location'] == 'kitakami'){
             if($_GET['lati'] < 100) {//テスト用
            // if(($_GET['lati'] > 140.940093) && ($_GET['lati'] < 141.283415) &&
            //    ($_GET['long'] > 39.155072) && ($_GET['long'] < 39.420794)) {
                echo 'ようこそ北上市へ.'.'<br />'.'雷獣をゲットしたよ！';

                echo $this->Form->create('Monsteruser', array('url' => 'saveimg'));
                echo $this->Form->hidden('kitakami',array('value' => 'kitakami_raiju.png'));//idをhiddenで取得
                echo $this->Form->hidden('id',array('value' => $_GET['id']));//idをhiddenで取得
                echo $this->Form->end('戻る');    
            }else {
                echo "位置情報が違います.北上市に行きましょう！";
                echo $this->Html->link('戻る',array('action' => 'kitakami'));
            }
        //岩手
        }else if($_GET['location'] == 'iwate') {
              if($_GET['lati'] < 100) {//テスト用
            // if(($_GET['lati'] > 141.013585) && ($_GET['lati'] < 141.356908) &&
            //    ($_GET['long'] > 39.837507) && ($_GET['long'] < 40.100626)) {
                echo 'ようこそ岩手町へ.'.'<br />'.'よろず姫と大蛇をゲットしたよ！';

                echo $this->Form->create('Monsteruser', array('url' => 'saveimg'));
                echo $this->Form->hidden('iwate',array('value' => 'yorujuhime&daija_iwate.png'));//idをhiddenで取得
                echo $this->Form->hidden('id',array('value' => $_GET['id']));//idをhiddenで取得
                echo $this->Form->end('戻る');    
            }else {
                echo "位置情報が違います.岩手町に行きましょう！";
                echo $this->Html->link('戻る',array('action' => 'iwate'));
            }
        //岩泉
        }else if($_GET['location'] == 'iwaizumi') {
            if($_GET['lati'] < 100) {//テスト用
            // if(($_GET['lati'] > 141.603407) && ($_GET['lati'] < 141.94673) &&
            //    ($_GET['long'] > 39.70927) && ($_GET['long'] < 39.972881)) {
                echo 'ようこそ岩泉町へ.'.'<br />'.'蛇龍をゲットしたよ！';

                echo $this->Form->create('Monsteruser', array('url' => 'saveimg'));
                echo $this->Form->hidden('iwaizumi',array('value' => 'jaryuu_iwaizumi.png'));//idをhiddenで取得
                echo $this->Form->hidden('id',array('value' => $_GET['id']));//idをhiddenで取得
                echo $this->Form->end('戻る');    
            }else {
                echo "位置情報が違います.岩泉町に行きましょう！";
                echo $this->Html->link('戻る',array('action' => 'iwaizumi'));
            }
        //一関
        }else if($_GET['location'] == 'itinoseki') {
             if($_GET['lati'] < 100) {//テスト用
            // if(($_GET['lati'] > 140.94648) && ($_GET['lati'] < 141.289571) &&
            //    ($_GET['long'] > 38.79691) && ($_GET['long'] < 39.063983)) {
                echo 'ようこそ一関市へ.'.'<br />'.'カニ坊主をゲットしたよ！';

                echo $this->Form->create('Monsteruser', array('url' => 'saveimg'));
                echo $this->Form->hidden('itinoseki',array('value' => 'kanibouzu_itinoseki.png'));//idをhiddenで取得
                echo $this->Form->hidden('id',array('value' => $_GET['id']));//idをhiddenで取得
                echo $this->Form->end('戻る');    
            }else {
                echo "位置情報が違います.一関市に行きましょう！";
                echo $this->Html->link('戻る',array('action' => 'itinoseki'));
            }
        //花巻
        }else if($_GET['location'] == 'hanamaki') {
                if($_GET['lati'] < 100) {//テスト用
            // if(($_GET['lati'] > 140.934599) && ($_GET['lati'] < 141.277922) &&
            //    ($_GET['long'] > 39.247126) && ($_GET['long'] < 39.512499)) {
                echo 'ようこそ花巻市へ.'.'<br />'.'座敷わらしをゲットしたよ！';

                echo $this->Form->create('Monsteruser', array('url' => 'saveimg'));
                echo $this->Form->hidden('hanamaki',array('value' => 'hanamaki_zasikiwarasi.png'));//idをhiddenで取得
                echo $this->Form->hidden('id',array('value' => $_GET['id']));//idをhiddenで取得
                echo $this->Form->end('戻る');    
            }else {
                echo "位置情報が違います.花巻市に行きましょう！";
                echo $this->Html->link('戻る',array('action' => 'hanamaki'));
            }
        //久慈
        }else if($_GET['location'] == 'kuzi') {
                if($_GET['lati'] < 100) {//テスト用
            // if(($_GET['lati'] > 141.610979) && ($_GET['lati'] < 141.954302) &&
            //    ($_GET['long'] > 40.061213) && ($_GET['long'] < 40.323471)) {
                echo 'ようこそ久慈市へ.'.'<br />'.'亡者船をゲットしたよ！';

                echo $this->Form->create('Monsteruser', array('url' => 'saveimg'));
                echo $this->Form->hidden('kuzi',array('value' => 'kuzishi_mojabune.png'));//idをhiddenで取得
                echo $this->Form->hidden('id',array('value' => $_GET['id']));//idをhiddenで取得
                echo $this->Form->end('戻る');    
            }else {
                echo "位置情報が違います.久慈市に行きましょう！";
                echo $this->Html->link('戻る',array('action' => 'kuzi'));
            }
        //二戸
        }else if ($_GET['location'] == 'ninohe') {
             if($_GET['lati'] < 100) {//テスト用
            // if(($_GET['lati'] > 141.124828) && ($_GET['lati'] < 141.46815) &&
            //    ($_GET['long'] > 40.140002) && ($_GET['long'] < 40.401955)) {
                echo 'ようこそ二戸市へ.'.'<br />'.'シタガラゴンボコをゲットしたよ！';

                echo $this->Form->create('Monsteruser', array('url' => 'saveimg'));
                echo $this->Form->hidden('ninohe',array('value' => 'ninohe_sitagarabonboko.png'));//idをhiddenで取得
                echo $this->Form->hidden('id',array('value' => $_GET['id']));//idをhiddenで取得
                echo $this->Form->end('戻る');    
            }else {
                echo "位置情報が違います.二戸市に行きましょう！";
                echo $this->Html->link('戻る',array('action' => 'ninohe'));
            }
        }else {
            echo "エラーです.homeに戻ります.";
            echo $this->Html->link('戻る',array('action' => 'index'));
        }
    
    // pr($data);
    // debug($d);

   
    
    }else {
        echo "NOW LOADING...";
    }
    
    



?>