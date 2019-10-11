<template>
  <div class="all">
    <h2 class="main-h2">選手登録情報</h2>

    <div class="add">
      <form action method="post">
        <div class="flex">
          <div class="item-1">
            <span class="name">パスワード：</span>
          </div>
          <div class="item-2">
            <input type="password" name="password" class="select" value>
          </div>
        </div>

        <div class="flex">
          <div class="item-1">
            <span class="name">パスワード確認用：</span>
          </div>
          <div class="item-2">
            <input type="password" name="password_confirmation" class="select" value>
          </div>
        </div>

        <div class="item-5">
          <a href class="btn cancel">戻る</a>
          <input type="submit" value="送信" class="btn">
        </div>
      </form>
    </div>
  </div>
</template>

<style lang="sass" scoped>
@import '../../sass/profileEdit.scss'
</style>