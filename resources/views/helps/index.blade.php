@extends('layouts.app')

@section('content')
<div class="container new-collection">
  <div class="row">
    <!--  -->
    <div class="col-xs-18 col-xs-offset-1 main">
      @include('commons._message')

      <!--  -->
      <form class="new_app_feedback" action="{{ route('helps.store') }}" method="post">
        {{ csrf_field() }}

        <h3>帮助与反馈</h3>
        <h6>如需帮助，请前往<a href="/faqs">简书帮助中心</a>，或者<a href="/contact">联系我们</a>。</h6>
        <h6>推荐加入简书用户群，第一时间获得回复。加入方式：添加"简书专题社群委员会委员长"微信号：Jianshu_dama，备注“简书web”。</h6>

        <!--  -->
        <table>
            <thead>
              <tr>
                <th class="setting-head"></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="setting-title pull-left setting-input">意见反馈</td>
                <td>
                  <textarea placeholder="填写意见反馈" name="content" required></textarea>
                </td>
              </tr>
            </tbody>
            <tbody class="base">
              <tr>
                <td class="setting-title pull-left setting-input">联系方式</td>
                <td>
                  <input placeholder="微信号 / 手机号 / QQ / 邮箱" type="text" name="contact" id="app_feedback_contact" required />
                  <p>留下您的联系方式，方便工作人员与您取得联系。</p>
                </td>
              </tr>
            </tbody>
          </table>
          <!--  -->
          <input type="submit" value="提交" class="btn btn-success">
      </form>
      <!--  -->
    </div>
  </div>
</div>
@endsection
