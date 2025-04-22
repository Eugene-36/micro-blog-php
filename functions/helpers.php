<?php

function getExcerpt($content, $limit = 400, $cutLength = 320)
{
	$content = trim($content);

	// Если текст короче лимита — возвращаем без изменений
	if (mb_strlen($content, 'UTF-8') <= $limit) {
		return $content;
	}

	// Обрезаем до указанной длины
	$excerpt = mb_substr($content, 0, $limit, 'UTF-8');

	// Ищем последнюю точку в пределах minCut - limit
	$lastDotPos = mb_strrpos($excerpt, '.', 0, 'UTF-8');

	if ($lastDotPos !== false) {
		$excerpt = mb_substr($excerpt, 0, $lastDotPos + 1, 'UTF-8'); // Обрезаем до точки
	} else {
		$excerpt = mb_substr($excerpt, 0, $cutLength, 'UTF-8'); // Если точки нет, просто обрезаем
		$excerpt .= '...';
	}

	return $excerpt;
}

function viewers_count() {
					
	session_start();

	// Check if the page view counter session variable exists
	
	if(isset($_SESSION['page_views']))
	{
		 // Increment the page view counter
		 $_SESSION['page_views']++;
	} else {
		 // Set the initial page view counter to 1
		 $_SESSION['page_views'] = 1;
	}
	

echo $_SESSION['views'];
};
