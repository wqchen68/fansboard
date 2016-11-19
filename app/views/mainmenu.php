<div ng-controller="menuController" class="onepcssgrid-full" id="topbar" style="position:relative;z-index:10">
    <div class="onerow" style="border-bottom: 1px solid #444; background-color: #000">
        <div class="onepcssgrid-1p-1200">

            <div class="onerow">
                <div class="col-1p3">
                    <a class="" href="/" style="width:241px;height:48px;display:inline-block;float:left;color:#fff;background:url('/images/home-logo.png');background-repeat:no-repeat;background-size: 241px 48px;background-position:center"></a>
                </div>
                <div class="col-1p9 last" style="height:48px;line-height:48px;background-color:#000;margin-bottom:0;padding:0">

                    <div style="line-height:48px;border-bottom:0;padding:0 0 0 50px">

                        <ul class="tabindex" style="margin:0 auto;padding:0">

                            <li class="tab" ng-repeat="menu in menus" ng-class="{active: menu.active}">
                                <div class="tab-title">
                                    <h4 class="title-default">{{menu.title}}</h4>
                                    <h4 class="empty" style="left:100%"></h4>
                                </div>
                                <ul style="width:100%">
                                    <li class="tabi" ng-repeat="item in menu.items">
                                        <a ng-click="activeItem(item, menu)" class="menu-tab-link button" ng-class="{active: item.active}">{{item.title}}</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>

        </div>
    </div>
    <div style="background-color:#888;content: '';display: table;width:100%;height:0;border-top:3px solid #b8860b;border-bottom:0px solid #000"></div>
</div>