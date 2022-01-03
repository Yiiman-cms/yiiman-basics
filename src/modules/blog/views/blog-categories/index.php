<?php
	
	use YiiMan\YiiBasics\modules\filemanager\widget\MediaViewWidget;
	use yii\helpers\Html;
	use yii\grid\GridView;
	use yii\widgets\Pjax;
	
	/* @var $this yii\web\View */
	/* @var $searchModel YiiMan\YiiBasics\modules\blog\models\SearchBlogArticles */
	/* @var $dataProvider yii\data\ActiveDataProvider */
	
	$this->title                   = Yii::t( 'blog' , 'دسته بندی مقالات' ) . ' ';
	$this->params['breadcrumbs'][] = $this->title;
	\system\widgets\topMenu\TopMenuWidget::addBtb(
	    'add',
	    Yii::t('blog', 'ثبت دسته بندی'),
	    'success',
	    null,
	    Yii::$app->Options->BackendUrl . '/blog/blog-category/create'
	);
	\system\widgets\backLang\backLangWidget::languages();
	
?>

<div class="blog-articles-index">
	
	<div class="card card-nav-tabs">
		<div class="card-body ">
			<h3 class="text-center"><?= Html::encode( $this->title ) ?></h3>
			
			<div class="row">
				<div class="col-md-12 pull-right">
					
					<?php Pjax::begin(); ?>
					
					<?= GridView::widget(
						[
							'dataProvider' => $dataProvider ,
							'filterModel'  => $searchModel ,
							'columns'      => [
								[ 'class' => 'yii\grid\SerialColumn' ] ,
								[
									'class'=>\YiiMan\YiiBasics\modules\gallery\grid\ImageColumn::className()
								] ,
								'title' ,


                                [
                                    'class' => 'YiiMan\YiiBasics\lib\ActionColumn',
                                ],
							] ,
						]
					); ?>
					<?php Pjax::end(); ?>
				</div>
			</div>
		
		
		</div>
	
	
	</div>
</div>
