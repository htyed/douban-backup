<?php
  // 获取传递的链接，为什么传递的链接不用原链接
  // notion传的链接字符数要<=100，完整链接会超字符
  $picnum = $_GET['p'];
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'https://img1.doubanio.com/view/photo/s_ratio_poster/public/' . $picnum);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
  $headers = array();
  $headers[] = 'Referer: https://movie.douban.com';
  $headers[] = 'User-Agent: PostmanRuntime/7.32.3';
  $headers[] = 'Host: img1.doubanio.com';
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $result = curl_exec($ch);
  if (curl_errno($ch)) {
      echo 'Error:' . curl_error($ch);
  }
  curl_close($ch);
  // 将获取的图片内容返回给前端
  header('Content-Type: image/jpeg');
  echo $result;
  // 清除缓冲区
  ob_flush();
  flush();
?>