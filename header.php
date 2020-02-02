<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
if (!empty($this->options->cdn) && $this->options->cdn) {
  define('__TYPECHO_THEME_URL__', Typecho_Common::url(__TYPECHO_THEME_DIR__ . '/' . basename(dirname(__FILE__)), $this->options->cdn));
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="<?php $this->options->charset(); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php $this->archiveTitle(array(
      'category' => _t('分类 %s 下的文章'),
      'search' => _t('包含关键字 %s 的文章'),
      'tag' => _t('标签 %s 下的文章'),
      'author' => _t('%s 发布的文章')
    ), '', ' - '); ?><?php $this->options->title(); ?><?php if ($this->is('index')): ?><?php if (!null == $this->options->Subtitle) {
      echo ' - ' . $this->options->Subtitle;
    } ?><?php endif; ?></title>
  <link rel="dns-prefetch" href="<?php $this->options->siteUrl(); ?>">
  <?php if (!empty($this->options->qiniu)): ?>
    <link rel="dns-prefetch" href="<?php echo $this->options->qiniu; ?>">
  <?php endif; ?>
  <?php if ($this->options->logoUrl): ?>
    <link rel="shortcut icon" href="<?= $this->options->logoUrl ?>" type="image/png"/>
  <?php endif; ?>
  <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
  <link type="text/css" rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.12.0/css/all.min.css">
  <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.min.css">
  <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/styles.css'); ?>">
  <?php if ($this->is('post')): ?>
    <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/style.css'); ?>">
  <?php endif; ?>
  <?php $this->header(); ?>
</head>
<body>
<div class="d-flex site-wrapper">
  <div class="d-block d-lg-none d-xl-none sidebar-wrapper">
    <div class="sidebar-container">
      <div class="d-flex justify-content-between sidebar-header">
        <div class="sidebar-title"><?php $this->options->title(); ?></div>
        <div class="d-flex sidebar-right">
          <div class="d-flex align-items-center justify-content-center sidebar-search click-search">
            <i class="fas fa-search"></i>
          </div>
          <div class="d-flex align-items-center justify-content-center sidebar-close">
            <i class="fas fa-times"></i>
          </div>
        </div>
      </div>
      <div class="list-group list-group-flush">
          <a id="home" class="list-group-item list-group-item-action menu-item <?php if ($this->is('index')) {
            echo 'active';
          } ?>" href="<?php $this->options->siteUrl(); ?>">首页</a>
        <?php $this->widget('Widget_Metas_Category_List')->to($category); ?>
        <?php while ($category->next()): ?>
          <a class="list-group-item list-group-item-action menu-item <?php if ($this->is('category', $category->slug)) {
              echo 'active';
            } ?>" href="<?php $category->permalink(); ?>"><?php $category->name(); ?></a>
        <?php endwhile; ?>
        <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
        <?php while ($pages->next()): ?>
        <a class="list-group-item list-group-item-action menu-item <?php if ($this->is('page', $pages->slug)) {
            echo 'active';
          } ?>" href="<?php $pages->permalink(); ?>"><?php $pages->title(); ?></a>
          <?php endwhile; ?>
      </div>
      <div class="mt-2 text-center sidebar-footer">
        <button type="button" class="btn site-tooltip btn-footer btn-dark-mode click-dark" data-toggle="tooltip"
                data-placement="bottom" title="切换风格">
          🌓
        </button>
      </div>
    </div>

  </div>
  <div class="main-wrapper">
    <header class="fixed-top shadow-sm main-header">
      <nav class="navbar navbar-expand-lg header-navbar">
        <div class="container">
          <a class="navbar-brand" href="/">
            <img src="https://getbootstrap.com/docs/4.4/assets/brand/bootstrap-solid.svg" width="30" height="30"
                 class="d-inline-block align-top navbar-brand-logo" alt="">
            <?php $this->options->title(); ?>
          </a>

          <button class="navbar-toggler sidebar-toggler" type="button" data-toggle="collapse"
                  aria-controls="sidebar-wrapper" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a id="home" class="nav-link <?php if ($this->is('index')) {
                  echo 'active';
                } ?>" href="<?php $this->options->siteUrl(); ?>">首页</a>
              </li>
              <?php $this->widget('Widget_Metas_Category_List')->to($category); ?>
              <?php while ($category->next()): ?>
                <li class="nav-item"><a class="nav-link <?php if ($this->is('category', $category->slug)) {
                    echo 'active';
                  } ?>" href="<?php $category->permalink(); ?>"><?php $category->name(); ?></a></li>
              <?php endwhile; ?>
              <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
              <?php while ($pages->next()): ?>
                <li class="nav-item"><a class="nav-link <?php if ($this->is('page', $pages->slug)) {
                    echo 'active';
                  } ?>" href="<?php $pages->permalink(); ?>"><?php $pages->title(); ?></a></li>
              <?php endwhile; ?>
            </ul>
            <div class="ml-auto nav-left">
              <button type="button" class="btn btn-light site-tooltip btn-nav-left btn-dark-mode click-dark"
                      data-toggle="tooltip" data-placement="bottom" title="切换风格">
                🌓
              </button>
              <button type="button" class="btn btn-light site-tooltip btn-nav-left btn-search click-search"
                      data-toggle="tooltip" data-placement="bottom" title="搜索文章">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </div>
      </nav>
    </header>
