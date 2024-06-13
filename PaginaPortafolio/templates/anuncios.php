<?php 
    const API_URL = 'https://api.atlasacademy.io/export/NA/basic_servant.json';
    $result = file_get_contents(API_URL);
    $dataFull = json_decode($result, true);
    if($flag == 1){
        $random = array_rand($dataFull, 3);
        $data[0] = $dataFull[$random[0]];
        $data[1] = $dataFull[$random[1]];
        $data[2] = $dataFull[$random[2]];
    }else {
        $data = $dataFull;
    };

    $classes = array(
        8 => "Shielder🛡️",
        1 => "Saber⚔️",
        2 => "Archer🏹",
        3 => "Lancer🔱",
        4 => "Rider🐎",
        5 => "Caster🧙‍♂️",
        6 => "Assasin💀",
        7 => "Berserker🤪",
        9 => "Ruler⚖️"
    );
?>
<div class="anuncios">
    <?php foreach($data as $servant){ ?>
        <div class="anuncio">
            <h3><?php echo $servant["name"]; ?></h3>
            <img src="<?php echo $servant["face"]; ?>" alt="">
            <div class="atributos">
                <h4>⚔️Atk: <?php echo $servant["atkMax"]; ?></h4>
                <h4>❤️Hp: <?php echo $servant["hpMax"]; ?></h4>
            </div>
            <h4>Class: <?php echo $classes[$servant["classId"]]; ?></h4>
        </div>
    <?php } ?>
</div>