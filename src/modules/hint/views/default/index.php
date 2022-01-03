<?php
use YiiMan\YiiBasics\modules\filemanager\widget\MediaViewWidget;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel YiiMan\YiiBasics\modules\hint\models\SearchHint */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('hint', 'Hint').' ';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="hint-index">
	<p>
		<?= Html::a(Yii::t('hint', 'Add Hint'), ['create'], ['class' => 'btn btn-success']) ?>
	</p>
	<div class="card card-nav-tabs">
		<div class="card-body ">
			<h3 class="text-center"><?= Html::encode($this->title) ?></h3>
			
			<div class="row">
				<div class="col-md-12 pull-right">
					
					    <?php Pjax::begin(); ?>
											    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
										
					
					
											<?= GridView::widget([
						'dataProvider' => $dataProvider,
						'filterModel' => $searchModel,
        'columns' => [
						['class' => 'yii\grid\SerialColumn'],
						
						            'date',
            'count',
            'url:url',
						
						['class' => 'yii\grid\ActionColumn'],
						],
						]); ?>
										    <?php Pjax::end(); ?>
				</div>
			</div>
		
		
		</div>
	
	
	</div>
</div>
