<?php
	
	use YiiMan\YiiBasics\modules\filemanager\widget\MediaViewWidget;
	use YiiMan\YiiBasics\modules\setting\widgets\ImageField;
	use yii\helpers\Html;
	use yii\widgets\DetailView;
	
	/* @var $this yii\web\View */
	/* @var $model YiiMan\YiiBasics\modules\blog\models\BlogArticles */
	
	$this->title                   = $model->title;
	$this->params['breadcrumbs'][] = [ 'label' => Yii::t( 'blog' , 'Blogs' ) , 'url' => [ 'index' ] ];
	$this->params['breadcrumbs'][] = $this->title;
	\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
	    'add',
	    Yii::t('blog', 'ثبت مقاله'),
	    'success',
	    null,
	    Yii::$app->Options->BackendUrl . '/blog/default/create'
	);


	\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
	    'edit',
	    Yii::t('blog', 'ویرایش این مورد'),
	    'info',
	    null,
	    Yii::$app->Options->BackendUrl . '/blog/default/update?id=' . $model->id);


	\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
	    'delete',
	    Yii::t('blog', 'حذف این مورد'),
	    'danger',
	    null,
	    Yii::$app->Options->BackendUrl . '/blog/default/delete?id=' . $model->id);

	\YiiMan\YiiBasics\widgets\backLang\backLangWidget::languages($model);

?>
<div class="blog-articles-view">

	<div class="row">
		<div class="col-md-12">
			<div class="card card-nav-tabs">
				<div class="card-body ">
					<h4 class="text-center"><?= Html::encode( $this->title ) ?></h4>
					<div class="row">
						<div class="col-md-offset-3 center-block" style="margin:auto;display: block">
                            <?php
                            if (!empty($model->loadDefaultImage())) {
                                ?>
                                <img  class="img img-rounded" style="margin: auto;display: block" src="<?= Yii::$app->UploadManager->getFit('dl/BlogArticles', $model->loadDefaultImage()->file_name . $model->loadDefaultImage()->extension, '870*412')
                                ?>">
                                <?php
                            }
                            ?>

						</div>
					</div>
					<div class="row">
						<div class="col-md-12 pull-right">
							<?= $model->content ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
