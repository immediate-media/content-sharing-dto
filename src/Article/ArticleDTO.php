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
    public string $ARTICLE_DTO_VERSION = '1.0.0';

    public string $type = 'article';
    public string $contentHtml;
    public string $contentText;

    protected array $validators = ['contentHtml', 'contentText'];


    public function getContentHtml(): string
    {
        return $this->contentHtml;
    }

    public function setContentHtml(string $contentHtml): void
    {
        $this->contentHtml = $contentHtml;
    }

    public function getContentText(): string
    {
        return $this->contentText;
    }

    public function setContentText(string $contentText): void
    {
        $this->contentText = $contentText;
    }

}