<?php

/*
 * This file is part of the PHP Translation package.
 *
 * (c) PHP Translation team <tobias.nyholm@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Translation\Extractor\Visitor\Php\Symfony;

use PhpParser\Node;
use PhpParser\Node\Stmt;

trait FormTrait
{
    private $isFormType = false;

    /**
     * Check if this node is a form type.
     *
     * @param Node $node
     *
     * @return bool
     */
    private function isFormType(Node $node)
    {
        // only Traverse *Type
        if ($node instanceof Stmt\Class_) {
            $this->isFormType = 'Type' === substr($node->name, -4);
        }

        return $this->isFormType;
    }
    
    /**
     * Several node types are not supported for translation extraction.
     *
     * As example: variables as keys are not supported, as their value can not get determined statically
     *
     * @param $attrValue
     * @return bool
     */
    private function isNotSupported($attrValue)
    {
        $attributeKeyIsVariable = $attrValue->key instanceof Node\Expr\Variable;

        return $attributeKeyIsVariable;
    }
}
