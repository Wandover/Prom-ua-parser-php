<?

$html = file_get_contents('https://prom.ua/Sportivnye-sumki'); # посилання на товар

$soup = new DOMDocument();
libxml_use_internal_errors(TRUE);
$soup->loadHTML($html);
libxml_clear_errors();
$xpath = new DOMXPath($soup);
$content = $xpath->query('//div[@class="x-catalog__content-line"]');
$articles = $xpath->query('//div[@class="x-gallery-tile__content"]');
$art_list = array();
foreach($articles as $article) {
    $name = $xpath->query('//span[@itemprop="name"]', $article)[0]->nodeValue;
    $price = $xpath->query('//div[@class="x-gallery-tile__price"]', $article)[0]->getAttribute('data-qaprice');
    $link = $xpath->query('//a[@class="x-gallery-tile__name"]', $article)[0]->getAttribute('href');
    $art_list[] = [$link, $price, $name];
}
print_r($art_list);

?>