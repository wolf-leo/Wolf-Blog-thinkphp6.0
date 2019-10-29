	var objOkTab = "";
	layui.use(["element", "layer", "okUtils", "okTab", "okLayer"], function () {
		var okUtils = layui.okUtils;
		var $ = layui.jquery;
		var layer = layui.layer;
		var okLayer = layui.okLayer;

		var okTab = layui.okTab({
			url: "/",
			openTabNum: 30, // 允许同时选项卡的个数
			parseData: function (data) { // 如果返回的结果和navs.json中的数据结构一致可省略这个方法
				return {};
			}
		});
		objOkTab = okTab;

		/**
		 * 左侧导航渲染完成之后的操作
		 */
		okTab.render(function () {
		});

		/**
		 * 添加新窗口
		 */
		$("body").on("click", "#navBars .layui-nav-item a,#userInfo a", function () {
			// 如果不存在子级
			if ($(this).siblings().length == 0) {
				okTab.tabAdd($(this));
			}
			// 关闭其他展开的二级标签
			$(this).parent("li").siblings().removeClass("layui-nav-itemed");
			if (!$(this).attr('lay-id')) {
				var topLevelEle = $(this).parents("li.layui-nav-item");
				var childs = $("#navBars > li > dl.layui-nav-child").not(topLevelEle.children("dl.layui-nav-child"));
				childs.removeAttr('style');
			}
		});
		$("body").on("click", ".layui-this a", function () {
			var _this = $(this);
			var iframes = $(".ok-tab-content iframe");
			var url = _this.attr("data-url");//选项卡的页面路径
			var tabId = _this.attr("lay-id");//选项卡ID
			var element = layui.element;
			var thatTabNum = $('.ok-tab-title > li').length;//当前已经打开的选项卡的数量
			for (var i = 0; i < thatTabNum; i++) {
				if ($('.ok-tab-title > li').eq(i).attr('lay-id') == tabId) {
					iframes[i].contentWindow.location.reload(true);
					iframes[i].src = url;
					return;
				}
			}
			console.log(url);
		});
		/**
		 * 左侧菜单展开动画
		 */
		$("#navBars").on('click', '.layui-nav-item a', function () {
			if (!$(this).attr('lay-id')) {
				var superEle = $(this).parent();
				var ele = $(this).next('.layui-nav-child');
				var height = ele.height();
				ele.css({'display': 'block'});
				if (superEle.is('.layui-nav-itemed')) {
					ele.height(0);
					ele.animate({
						height: height + 'px'
					}, function () {
						ele.css({
							height: "auto"
						});
						//ele.removeAttr('style');
					});
				} else {
					ele.animate({
						height: 0
					}, function () {
						ele.removeAttr('style');
					});
				}
			}
		});

		/**
		 * 左边菜单显隐功能
		 */
		$(".ok-menu").click(function () {
			$(".layui-layout-admin").toggleClass("ok-left-hide");
			$(this).find('i').toggleClass("ok-menu-hide");
			localStorage.setItem("isResize", false);
			setTimeout(function () {
				localStorage.setItem("isResize", true);
			}, 1200);
		});

		/**
		 * 移动端的处理事件
		 */
		$("body").on("click", ".layui-layout-admin .ok-left a[data-url],.ok-make", function () {
			if ($(".layui-layout-admin").hasClass("ok-left-hide")) {
				$(".layui-layout-admin").removeClass("ok-left-hide");
				$(".ok-menu").find('i').removeClass("ok-menu-hide");
			}
		});

		/**
		 * tab左右移动
		 */
		$("body").on("click", ".okNavMove", function () {
			var moveId = $(this).attr("data-id");
			var that = this;
			okTab.navMove(moveId, that);
		});

		/**
		 * 刷新当前tab页
		 */
		$("body").on("click", ".ok-refresh", function () {
			okTab.refresh(this);
		});

		/**
		 * 关闭tab页
		 */
		$("body").on("click", "#tabAction a", function () {
			var num = $(this).attr('data-num');
			okTab.tabClose(num);
		});

		/**
		 * 全屏/退出全屏
		 */
		$("body").on("keydown", function (event) {
			event = event || window.event || arguments.callee.caller.arguments[0];
			// 按 Esc
			if (event && event.keyCode == 27) {
				console.log("Esc");
				$("#fullScreen").children("i").eq(0).removeClass("okicon-screen-restore");
			}
			// 按 F11
			if (event && event.keyCode == 122) {
				$("#fullScreen").children("i").eq(0).addClass("okicon-screen-restore");
			}
		});

		$("body").on("click", "#fullScreen", function () {
			if ($(this).children("i").hasClass("okicon-screen-restore")) {
				screenFun(2).then(function () {
					$(this).children("i").eq(0).removeClass("okicon-screen-restore");
				});
			} else {
				screenFun(1).then(function () {
					$(this).children("i").eq(0).addClass("okicon-screen-restore");
				});
			}
		});

		/**
		 * 全屏和退出全屏的方法
		 * @param num 1代表全屏 2代表退出全屏
		 * @returns {Promise}
		 */
		function screenFun(num) {
			num = num || 1;
			num = num * 1;
			var docElm = document.documentElement;

			switch (num) {
				case 1:
					if (docElm.requestFullscreen) {
						docElm.requestFullscreen();
					} else if (docElm.mozRequestFullScreen) {
						docElm.mozRequestFullScreen();
					} else if (docElm.webkitRequestFullScreen) {
						docElm.webkitRequestFullScreen();
					} else if (docElm.msRequestFullscreen) {
						docElm.msRequestFullscreen();
					}
					break;
				case 2:
					if (document.exitFullscreen) {
						document.exitFullscreen();
					} else if (document.mozCancelFullScreen) {
						document.mozCancelFullScreen();
					} else if (document.webkitCancelFullScreen) {
						document.webkitCancelFullScreen();
					} else if (document.msExitFullscreen) {
						document.msExitFullscreen();
					}
					break;
			}

			return new Promise(function (res, rej) {
				res("返回值");
			});
		}

		/**
		 * 捐赠作者
		 */
		$(".layui-footer button.donate").click(function () {
			layer.tab({
				area: ["330px", "350px"],
				tab: [{
						title: "支付宝",
						content: "<img src='images/zfb.jpg' width='200' height='300' style='margin-left: 60px'>"
					}, {
						title: "微信",
						content: "<img src='images/wx.jpg' width='200' height='300' style='margin-left: 60px'>"
					}]
			});
		});

		/**
		 * QQ群交流
		 */
		$("body").on("click", ".layui-footer button.communication,#noticeQQ", function () {
			layer.tab({
				area: ["330px", "350px"],
				tab: [{
						title: "QQ群",
						content: "<img src='images/qq.jpeg' width='200' height='300' style='margin-left: 60px'>"
					}]
			});
		});

		/**
		 * 退出操作
		 */
		$("#logout").click(function () {
			var url = $(this).attr('data-url');
			okLayer.confirm("确定要退出吗？", function (index) {
				window.location = url;
			});
		});
	});
