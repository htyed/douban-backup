>感谢大佬[bambooom](https://github.com/bambooom)的付出，原项目链接：https://github.com/bambooom/douban-backup
>
>在这里记录一下自己在青龙面板实践整个项目的过程，根据自己的习惯进行了一小部分修改
>
>这个分支是最新版，包含 Notion 和 NeoDB，与原项目同步更新。。。
>另一个分支只包含Notion，青龙面板消息通知更全面，应该不会更新了，留个档备份~

# README

## 1、油猴脚本导出csv

安装[油猴脚本](https://greasyfork.org/zh-CN/scripts/420999-%E8%B1%86%E7%93%A3%E8%AF%BB%E4%B9%A6-%E7%94%B5%E5%BD%B1-%E9%9F%B3%E4%B9%90-%E6%B8%B8%E6%88%8F-%E8%88%9E%E5%8F%B0%E5%89%A7%E5%AF%BC%E5%87%BA%E5%B7%A5%E5%85%B7)→导出豆瓣csv

## 2、保存Notion模板副本，并导入csv

- [movie template（新）](https://htyed.notion.site/cd4657d7229b41ff82efb1fce255dca5?v=40bf1445ed5144c5b9694cb4f6930c65)
- [book template](https://bambooo.notion.site/2c6d35b0e1414af387f9e2a20d10cb4c?v=33be13cbae1f4bf581d325dfa1fa5604)
- [music template](https://bambooo.notion.site/43a25b0e62354cc4a38a8aa0c60ac31c?v=45b0b31a85804b42a8993e99b63e3f47)
- [game template](https://bambooo.notion.site/0fcb63ccfc65455b9349b29685690b71?v=5fc35837865640fe8e008ef80961d87f)
- [drama templa](https://bambooo.notion.site/29233844d4e34a9eb6fd48fb0a7b1598?v=8e9681e173204853b3df0d8c10f0e549)

> 变化：在电影页面增加一列 制片国家/地区，属性选择文本 | 电影名改为标题

## 3、用脚本补全信息

使用 `update-notion.js` 脚本，用最新的 csv 文件作为输入，将刮削等待时间改成30s（防止被禁IP，但好像保证一分钟小于40次访问就可以，反正在后台慢慢运行，也不急），选择0模式（不跳过）

## 4、通过rss更新最新十条豆瓣信息

使用 `sync-rss.js` 脚本获取 RSS 数据，对新加入的条目进行抓取信息，处理后添加到对应的 notion database 中即可。


## 5、NeoDB 配置（新）

在 [文档页面](https://neodb.social/developer/) 生成一个 Token，命名 NEODB_API_TOKEN 放到环境变量中。

## 6、解决DB 图片加载不出来（新）

- 方案一：用 index.php 文件 部署一个网站，绑定域名/端口。

>网站关闭后，图片就全加载不出来了，除非能保证这个代理网站长期在线。

- 方案二：定期手动上传对应图片到notion。
>最稳定，就是麻烦

- 方案三：保持现有链接不变，期待DB官方取消防盗链（目前不可行）
>够呛

- 方案四：直接将图片上传到Notion图床（目前不可行）
>找了很久如何直接上传图片到notion的方法，没找到，期待Notion官方开放上传文件的API吧。

## 7、青龙面板配置（新）
1. 青龙拉库 

   ```
   ql repo https://ghproxy.com/https://github.com/htyed/douban-backup.git "sync-rss" "" "db-notes-img-dl|export-note.user|export.user|package|package-lock|update-notion|util" "main" "js|json"
   ```

2. 在青龙docker容器的终端机里执行命令

   ```
   cd 项目目录
   npm install
   ```

3. 环境变量里添加对应变量

## 8、青龙面板环境变量汇总（新）

| 环境变量                         | 值                     | 备注          |
| -------------------------------- | ---------------------- | ------------- |
| DOUBAN_USER_ID                   | xxxxxxx                | 豆瓣 用户名   |
| NOTION_TOKEN                     | secret_xxxxxxxxxxxxxxx | Notion token  |
| NEODB_API_TOKEN                  | xxxxxxxxxxxxxxx        | NeoDB token   |
| NOTION_BOOK_DATABASE_ID（可选）  | xxxxxxxxxxxxxxx        | 图书          |
| NOTION_MOVIE_DATABASE_ID（可选） | xxxxxxxxxxxxxxx        | 电影          |
| NOTION_GAME_DATABASE_ID（可选）  | xxxxxxxxxxxxxxx        | 游戏          |
| NOTION_MUSIC_DATABASE_ID（可选） | xxxxxxxxxxxxxxx        | 音乐          |
| NOTION_DRAMA_DATABASE_ID（可选） | xxxxxxxxxxxxxxx        | 戏剧          |
| GOTIFY_URL（可选）               | https://xxx.xxx.xxx    | Gotify 地址   |
| GOTIFY_TOKEN_DB（可选）          | xxxxxxxxxxxxxxx        | Gotify token  |
| PROXY_DB（可选）                 | https://xxx.xxx.xxx/   | 图片代理 地址 |



## TODO

- [x] 支持消息推送（目前只支持 Gotify 通知）
- [ ] 改进文件，无需执行额外的命令行操作



## 同类项目

Douban-backup（原项目）教程：https://zhuzi.dev/2021/06/05/douban-backup-sync-notion
Notion_sync_data：https://github.com/Qliangw/notion_sync_data
Notion API × 豆瓣电影/图书：https://djdjs.notion.site/djdjs/Notion-API-7fe0ab77c9ba49d1bb1bbd7963a502dc
Notion Transfer：https://github.com/lccurious/notion-transfer