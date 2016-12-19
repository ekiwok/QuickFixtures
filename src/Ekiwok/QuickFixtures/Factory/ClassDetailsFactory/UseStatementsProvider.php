<?php

namespace Ekiwok\QuickFixtures\Factory\ClassDetailsFactory;

class UseStatementsProvider implements UseStatementsProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getUseStatements(\ReflectionClass $class)
    {
        $imports = [];

        $fileName = $class->getFileName();
        $file = fopen($fileName, 'r');
        $source = fread($file, filesize($fileName));

        $tokens = token_get_all($source);

        while (current($tokens)[0] !== T_CLASS) {
            next($tokens);
            $this->rewindToUseTokenOrClassToken($tokens);
            if (current($tokens)[0] === T_USE) {
                /** @var array $aliases */
                list($aliases, $import) = $this->parseUseStatement($tokens);
                foreach ($aliases as $alias) {
                    $imports[$alias] = $import;
                }
            }
        }

        fclose($file);

        return $imports;
    }

    private function rewindToUseTokenOrClassToken(array &$tokens)
    {
        while (current($tokens)[0] !== T_USE && current($tokens)[0] !== T_CLASS) {
            next($tokens);
        }
    }

    /**
     * @todo redo
     *
     * @param array $tokens
     *
     * @return array
     */
    private function parseUseStatement(array &$tokens)
    {
        $aliases = [];
        $elements = [];

        for ($current = next($tokens); $current[0] != ';'; $current = next($tokens)) {
            switch($current[0])
            {
                case T_STRING:
                    $elements[] = $current[1];
                break;

                case T_AS:
                    for ($current = next($tokens); $current[0] != ';'; $current = next($tokens)) {
                        if ($current[0] == T_STRING) {
                            $aliases[] = $current[1];
                        }
                    }
                break;
            }
        }

        if (empty($aliases)) {
            $aliases[] = end($elements);
        }

        $namespace = implode('\\', $elements);

        return [$aliases, $namespace];
    }
}
