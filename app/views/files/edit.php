<?php echo $header ?>

<div class="content filedetails">

  <div class="filedetails__preview">
    <figure class="filedetails__thumb" ng-show="file.type == 'image'" style="background-image: url({{file.url}})">
      <a target="_blank" href="{{file.url}}"></a>
    </figure>
    <figure class="filedetails__icon" ng-show="file.type != 'image'">
      <a target="_blank" href="{{file.url}}"><i class="fa fa-file"></i> {{file.extension}}</a>
    </figure>

    <a ng-show="file.prev" class="filedetails__prevnext filedetails__prevnext--prev" ui-sref="file({filename: file.prev.filename, uri: page.uri})"><i class="fa fa-chevron-left fa-lg"></i></a>
    <a ng-show="file.next" class="filedetails__prevnext filedetails__prevnext--next" ui-sref="file({filename: file.next.filename, uri: page.uri})"><i class="fa fa-chevron-right fa-lg"></i></a>

  </div><!--

--><div class="filedetails__sidebar">

    <form ng-show="view == 'form'" class="filedetails__form form grid" ng-class="{loading: loading}" ng-submit="submit()">

      <div class="form__alert grid__item" ng-show="message" ng-click="alert('')">
        {{message}}
      </div>

      <div class="form__field grid__item">
        <label class="form__label">
          Filename
          <span class="form__labelOption">
            <a ng-click="show('replace')" href=""><i class="fa fa-cloud-upload"></i> Replace</a>
            <a ng-click="show('delete')" href=""><i class="fa fa-trash-o"></i> Delete</a>
          </span>
        </label>
        <div class="form__inputWrapper">
          <input class="form__input" type="text" placeholder="Filename" ng-model="file.name" required autofocus>
          <span class="form__inputAppendix"><i>.{{file.extension}}</i></span>
        </div>
      </div>

      <div class="form__field grid__item">
        <label class="form__label">Type / Size</label>
        <div class="form__input form__input--readonly">{{file.type}} / {{file.size}}</div>
      </div>

      <div class="form__field grid__item">
        <label class="form__label">Public link</label>
        <div class="form__inputWrapper">
          <input class="form__input form__input--readonly" type="text" readonly ng-model="file.url">
          <span class="form__inputIcon form__inputIcon--readonly">
            <i class="fa fa-chain"></i>
          </span>
        </div>
      </div>

      <div ng-include="'api/files/form/?uri=' + page.uri"></div>

      <div class="form__buttons form__buttons--centered grid__item">
        <input type="submit" class="form__button" value="save">
      </div>

    </form>

    <div ng-show="view == 'replace'">

      <h1 class="beta">Replace {{file.filename}}</h1>

      <form class="filedetails__dz dz" action="api/files/replace" dropzone options="dropOptions" done="replace()">
        <strong>Drop a file here…</strong>
        <small>or click to replace this file</small>
        <input type="hidden" name="filename" ng-value="file.filename">
        <input type="hidden" name="uri" ng-value="page.uri">
      </form>

      <div class="form__buttons form__buttons--centered">
        <input type="button" ng-click="show('form')" class="form__button" value="cancel">
      </div>

    </div>

    <form ng-show="view == 'delete'" class="form" ng-submit="delete()">

      <div class="form__alert" ng-show="message" ng-click="alert('')">
        {{message}}
      </div>

      <div class="form__field">
        <label class="form__label">Do you really want to delete this file?</label>
        <div class="form__input form__input--readonly">{{file.filename}}</div>
      </div>

      <div class="form__buttons">
        <input tabindex="-1" type="reset" class="form__button form__button--cancel" ng-click="show('form')" value="cancel">
        <input type="submit" class="form__button form__button--submit form__button--negative" autofocus="autofocus" value="delete">
      </div>
    </form>

  </div>

</div>