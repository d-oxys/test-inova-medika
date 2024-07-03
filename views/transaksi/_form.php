<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Pasien;
use app\models\Obat;
use app\models\Tindakan;
use yii\base\DynamicModel;

/** @var yii\web\View $this */
/** @var app\models\Transaksi $model */
/** @var yii\widgets\ActiveForm $form */

$dynamicModel = DynamicModel::validateData(['keluhanPasien' => ''], [['keluhanPasien', 'string']]);
?>

<div class="transaksi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_pasien')->dropDownList(
        ArrayHelper::map(Pasien::find()->all(), 'id', 'nama'),
        ['prompt' => 'Pilih Pasien',
         'onchange'=>'
            $.post( "index.php?r=pasien/lists&id='.'"+$(this).val(), function( data ) {
              $( "#keluhanPasien" ).val( data );
              console.log(data)
            });
        ']
    ) ?>

    <?= $form->field($model, 'keluhan')->textInput(['id' => 'keluhanPasien', 'readonly' => true]) ?>

    <?= $form->field($model, 'tanggal')->widget(\kartik\date\DatePicker::classname(), [
    'options' => ['placeholder' => 'Pilih tanggal ...'],
    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd'
    ]
]); ?>


    <?= $form->field($model, 'id_obat')->dropDownList(
        ArrayHelper::map(Obat::find()->all(), 'id', 'nama'),
        ['prompt' => 'Pilih Obat',
         'onchange'=>'
            $.post( "index.php?r=obat/lists&id='.'"+$(this).val(), function( data ) {
              $( "input#transaksi-total_harga" ).val( data );
            });
        ']
    ) ?>

    <?= $form->field($model, 'id_tindakan')->dropDownList(
        ArrayHelper::map(Tindakan::find()->all(), 'id', 'nama'),
        ['prompt' => 'Pilih Tindakan',
         'onchange'=>'
            $.post( "index.php?r=tindakan/lists&id='.'"+$(this).val(), function( data ) {
              var total = parseFloat($( "input#transaksi-total_harga" ).val()) + parseFloat(data);
              $( "input#transaksi-total_harga" ).val( total );
            });
        ']
    ) ?>

    <?= $form->field($model, 'total_harga')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
