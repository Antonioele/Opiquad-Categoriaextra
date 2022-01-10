<?php

namespace Opiquad\Categoriaextra\Api\Data;

interface CategoriaextraInterface
{
    /**
     * String constants for property names
     */
    const ENTITY_ID = "entity_id";
    const CATEGORY_ID = "category_id";
    const TITLE = "title";
    const SPECIAL_CLASS = "special_class";
    const CATEGORIE = "categorie";
    const STATUS = "status";
    const STORE = "store";
    const POSITION = "position";

    /**
     * Getter for EntityId.
     *
     * @return int|null
     */
    public function getEntityId(): ?int;

    /**
     * Setter for EntityId.
     *
     * @param int|null $entityId
     *
     * @return void
     */
    public function setEntityId(?int $entityId): void;

    /**
     * Getter for CategoryId.
     *
     * @return int|null
     */
    public function getCategoryId(): ?int;

    /**
     * Setter for CategoryId.
     *
     * @param int|null $categoryId
     *
     * @return void
     */
    public function setCategoryId(?int $categoryId): void;

    /**
     * Getter for Title.
     *
     * @return string|null
     */
    public function getTitle(): ?string;

    /**
     * Setter for Title.
     *
     * @param string|null $title
     *
     * @return void
     */
    public function setTitle(?string $title): void;

    /**
     * Getter for SpecialClass.
     *
     * @return string|null
     */
    public function getSpecialClass(): ?string;

    /**
     * Setter for SpecialClass.
     *
     * @param string|null $specialClass
     *
     * @return void
     */
    public function setSpecialClass(?string $specialClass): void;

    /**
     * Getter for Categorie.
     *
     * @return string|null
     */
    public function getCategorie(): ?string;

    /**
     * Setter for Categorie.
     *
     * @param string|null $categorie
     *
     * @return void
     */
    public function setCategorie(?string $categorie): void;

    /**
     * Getter for Status.
     *
     * @return int|null
     */
    public function getStatus(): ?int;

    /**
     * Setter for Status.
     *
     * @param int|null $status
     *
     * @return void
     */
    public function setStatus(?int $status): void;

    /**
     * Getter for Store.
     *
     * @return int|null
     */
    public function getStore(): ?int;

    /**
     * Setter for Store.
     *
     * @param int|null $store
     *
     * @return void
     */
    public function setStore(?int $store): void;

    /**
     * Getter for Position.
     *
     * @return int|null
     */
    public function getPosition(): ?int;

    /**
     * Setter for Position.
     *
     * @param int|null $position
     *
     * @return void
     */
    public function setPosition(?int $position): void;
}
