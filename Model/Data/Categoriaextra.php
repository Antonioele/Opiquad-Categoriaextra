<?php

namespace Opiquad\Categoriaextra\Model\Data;

use Magento\Framework\DataObject;
use Opiquad\Categoriaextra\Api\Data\CategoriaextraInterface;

class Categoriaextra extends DataObject implements CategoriaextraInterface
{
    /**
     * @inheritDoc
     */
    public function getEntityId(): ?int
    {
        return $this->getData(self::ENTITY_ID) === null ? null
            : (int)$this->getData(self::ENTITY_ID);
    }

    /**
     * @inheritDoc
     */
    public function setEntityId(?int $entityId): void
    {
        $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * @inheritDoc
     */
    public function getCategoryId(): ?int
    {
        return $this->getData(self::CATEGORY_ID) === null ? null
            : (int)$this->getData(self::CATEGORY_ID);
    }

    /**
     * @inheritDoc
     */
    public function setCategoryId(?int $categoryId): void
    {
        $this->setData(self::CATEGORY_ID, $categoryId);
    }

    /**
     * @inheritDoc
     */
    public function getTitle(): ?string
    {
        return $this->getData(self::TITLE);
    }

    /**
     * @inheritDoc
     */
    public function setTitle(?string $title): void
    {
        $this->setData(self::TITLE, $title);
    }

    /**
     * @inheritDoc
     */
    public function getSpecialClass(): ?string
    {
        return $this->getData(self::SPECIAL_CLASS);
    }

    /**
     * @inheritDoc
     */
    public function setSpecialClass(?string $specialClass): void
    {
        $this->setData(self::SPECIAL_CLASS, $specialClass);
    }

    /**
     * @inheritDoc
     */
    public function getCategorie(): ?string
    {
        return $this->getData(self::CATEGORIE);
    }

    /**
     * @inheritDoc
     */
    public function setCategorie(?string $categorie): void
    {
        $this->setData(self::CATEGORIE, $categorie);
    }

    /**
     * @inheritDoc
     */
    public function getStatus(): ?int
    {
        return $this->getData(self::STATUS) === null ? null
            : (int)$this->getData(self::STATUS);
    }

    /**
     * @inheritDoc
     */
    public function setStatus(?int $status): void
    {
        $this->setData(self::STATUS, $status);
    }

    /**
     * @inheritDoc
     */
    public function getStore(): ?int
    {
        return $this->getData(self::STORE) === null ? null
            : (int)$this->getData(self::STORE);
    }

    /**
     * @inheritDoc
     */
    public function setStore(?int $store): void
    {
        $this->setData(self::STORE, $store);
    }

    /**
     * @inheritDoc
     */
    public function getPosition(): ?int
    {
        return $this->getData(self::POSITION) === null ? null
            : (int)$this->getData(self::POSITION);
    }

    /**
     * @inheritDoc
     */
    public function setPosition(?int $position): void
    {
        $this->setData(self::POSITION, $position);
    }
}
