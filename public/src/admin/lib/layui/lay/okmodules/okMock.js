"use strict";
layui.define([], function(exprots) {
	var okMock = {
		api: {
            login: "https://www.easy-mock.com/mock/5d5d0dd46cfcbd1b8627bf1d/ok-admin-v2.0/login",
            menu: {
                list: "https://easy-mock.com/mock/5d0ce725424f15399a6c2068/okadmin/menu/list"
            },
            user: {
                list: "https://www.easy-mock.com/mock/5d5d0dd46cfcbd1b8627bf1d/ok-admin-v2.0/user/list",
                list2: "https://www.easy-mock.com/mock/5d5d0dd46cfcbd1b8627bf1d/ok-admin-v2.0/user/list2",
                batchNormal: "https://www.easy-mock.com/mock/5d5d0dd46cfcbd1b8627bf1d/ok-admin-v2.0/user/batchNormal",
                batchStop: "https://www.easy-mock.com/mock/5d5d0dd46cfcbd1b8627bf1d/ok-admin-v2.0/user/batchStop",
                batchDel: "https://www.easy-mock.com/mock/5d5d0dd46cfcbd1b8627bf1d/ok-admin-v2.0/user/batchDel",
                add: "https://www.easy-mock.com/mock/5d5d0dd46cfcbd1b8627bf1d/ok-admin-v2.0/user/add",
                edit: "https://www.easy-mock.com/mock/5d5d0dd46cfcbd1b8627bf1d/ok-admin-v2.0/user/edit"
            },
            role: {
                list: "https://www.easy-mock.com/mock/5d5d0dd46cfcbd1b8627bf1d/ok-admin-v2.0/role/list"
            },
            permission: {
                tree: "https://www.easy-mock.com/mock/5d5d0dd46cfcbd1b8627bf1d/ok-admin-v2.0/permission/tree",
                list: "https://www.easy-mock.com/mock/5d5d0dd46cfcbd1b8627bf1d/ok-admin-v2.0/permission/list",
                list2: "https://www.easy-mock.com/mock/5d5d0dd46cfcbd1b8627bf1d/ok-admin-v2.0/permission/list2"
            },
            article: {
                list: "https://www.easy-mock.com/mock/5d5d0dd46cfcbd1b8627bf1d/ok-admin-v2.0/article/list"
            },
			task: {
			    list: "https://www.easy-mock.com/mock/5d5d0dd46cfcbd1b8627bf1d/ok-admin-v2.0/task/list"
			},
			link: {
				list: "https://www.easy-mock.com/mock/5d5d0dd46cfcbd1b8627bf1d/ok-admin-v2.0/link/list"
			},
            product: {
                list: "https://www.easy-mock.com/mock/5d5d0dd46cfcbd1b8627bf1d/ok-admin-v2.0/product/list"
            },
            log: {
                list: "https://easy-mock.com/mock/5d0ce725424f15399a6c2068/okadmin/log/list"
            },
            message: {
                list: "https://www.easy-mock.com/mock/5d5d0dd46cfcbd1b8627bf1d/ok-admin-v2.0/message/list"
            },
			download: {
			    list: "https://www.easy-mock.com/mock/5d5d0dd46cfcbd1b8627bf1d/ok-admin-v2.0/download/list"
			},
			bbs: {
			    list: "https://www.easy-mock.com/mock/5d5d0dd46cfcbd1b8627bf1d/ok-admin-v2.0/bbs/list"
			}
        }
	};
	exprots("okMock", okMock);
});
