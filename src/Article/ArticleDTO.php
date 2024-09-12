<?php

namespace ImmediateMedia\ContentSharingDto\Article;

use ImmediateMedia\ContentSharingDto\BaseDTO;

/**
 * Class ArticleDTO
 * @package ImmediateMedia\ContentSharingDto\Article
 */
class ArticleDTO extends BaseDTO
{

    // Bump this version when you make a breaking change to the DTO
    public string $ARTICLE_DTO_VERSION = '1.0.1';

    public string $type = 'article';
    public string $text;
    public string $html;
    public string $markdown;

    protected array $validators = ['html'];

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getHtml(): string
    {
        return $this->html;
    }

    public function setHtml(string $html): void
    {
        $this->html = $html;
        $this->setText(strip_tags($html));
    }

    public function getMarkdown(): string
    {
        return $this->markdown;
    }

    public function setMarkdown(string $markdown): void
    {
        $this->markdown = $markdown;
    }

    /**
     * Map JSON Object to ArticleDTO
     * @param string $jsonData ArticleJson
     * @throws \JsonException
     */
    public function map(string $jsonData) : void
    {
        parent::map($jsonData);
        $data = json_decode($jsonData, false, 512, JSON_THROW_ON_ERROR);

        if(isset($data->html)) {
            $this->setHtml($data->html);
        }

        if(isset($data->text)) {
            $this->setText($data->text);
        }

        if(isset($data->markdown)) {
            $this->setMarkdown($data->markdown);
        }
    }
}
