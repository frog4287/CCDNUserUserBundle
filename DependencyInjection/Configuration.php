<?php

/*
 * This file is part of the CCDNUser UserBundle
 *
 * (c) CCDN (c) CodeConsortium <http://www.codeconsortium.com/>
 *
 * Available on github <http://www.github.com/codeconsortium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CCDNUser\UserBundle\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 *
 * @author Reece Fowell <reece@codeconsortium.com>
 * @version 1.0
 */
class Configuration implements ConfigurationInterface
{
	
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ccdn_user_user');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.
        $rootNode
            ->addDefaultsIfNotSet()
            ->canBeUnset()
            ->children()
                ->arrayNode('user')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->scalarNode('profile_route')->defaultValue('ccdn_user_profile_show_by_id')->end()
                    ->end()
                ->end()
                ->arrayNode('template')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->scalarNode('engine')->defaultValue('twig')->end()
                    ->end()
                ->end()
            ->end();

        $this->addSEOSection($rootNode);
        $this->addAccountSection($rootNode);
        $this->addChangePasswordSection($rootNode);
        $this->addRegistrationSection($rootNode);
        $this->addResettingSection($rootNode);
        $this->addSecuritySection($rootNode);
        $this->addLegalSection($rootNode);
        $this->addSidebarSection($rootNode);

        return $treeBuilder;
    }

    /**
     *
     * @access protected
     * @param ArrayNodeDefinition $node
     */
    protected function addSEOSection(ArrayNodeDefinition $node)
    {
        $node
            ->addDefaultsIfNotSet()
            ->canBeUnset()
            ->children()
                ->arrayNode('seo')
                ->addDefaultsIfNotSet()
                ->canBeUnset()
                    ->children()
                        ->scalarNode('title_length')->defaultValue('67')->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     *
     * @access private
     * @param ArrayNodeDefinition $node
     */
    private function addAccountSection(ArrayNodeDefinition $node)
    {
        $node
            ->addDefaultsIfNotSet()
            ->canBeUnset()
            ->children()
                ->arrayNode('account')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->arrayNode('show')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->scalarNode('layout_template')->defaultValue('CCDNComponentCommonBundle:Layout:layout_body_right.html.twig')->end()
                            ->end()
                        ->end()
                        ->arrayNode('edit')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->scalarNode('layout_template')->defaultValue('CCDNComponentCommonBundle:Layout:layout_body_right.html.twig')->end()
                                ->scalarNode('form_theme')->defaultValue('CCDNUserUserBundle:Form:fields.html.twig')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     *
     * @access private
     * @param ArrayNodeDefinition $node
     */
    private function addChangePasswordSection(ArrayNodeDefinition $node)
    {
        $node
            ->addDefaultsIfNotSet()
            ->canBeUnset()
            ->children()
                ->arrayNode('password')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->arrayNode('change_password')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->scalarNode('layout_template')->defaultValue('CCDNComponentCommonBundle:Layout:layout_body_right.html.twig')->end()
                                ->scalarNode('form_theme')->defaultValue('CCDNUserUserBundle:Form:fields.html.twig')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     *
     * @access private
     * @param ArrayNodeDefinition $node
     */
    private function addRegistrationSection(ArrayNodeDefinition $node)
    {
        $node
            ->addDefaultsIfNotSet()
            ->canBeUnset()
            ->children()
                ->arrayNode('registration')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->arrayNode('register')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->scalarNode('layout_template')->defaultValue('CCDNComponentCommonBundle:Layout:layout_body_right.html.twig')->end()
                                ->scalarNode('form_theme')->defaultValue('CCDNUserUserBundle:Form:fields.html.twig')->end()
                            ->end()
                        ->end()
                        ->arrayNode('check_email')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->scalarNode('layout_template')->defaultValue('CCDNComponentCommonBundle:Layout:layout_body_right.html.twig')->end()
                            ->end()
                        ->end()
                        ->arrayNode('confirmed')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->scalarNode('layout_template')->defaultValue('CCDNComponentCommonBundle:Layout:layout_body_right.html.twig')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     *
     * @access private
     * @param ArrayNodeDefinition $node
     */
    private function addResettingSection(ArrayNodeDefinition $node)
    {
        $node
            ->addDefaultsIfNotSet()
            ->canBeUnset()
            ->children()
                ->arrayNode('resetting')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->arrayNode('request')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->scalarNode('layout_template')->defaultValue('CCDNComponentCommonBundle:Layout:layout_body_right.html.twig')->end()
                            ->end()
                        ->end()
                        ->arrayNode('password_already_requested')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->scalarNode('layout_template')->defaultValue('CCDNComponentCommonBundle:Layout:layout_body_right.html.twig')->end()
                            ->end()
                        ->end()
                        ->arrayNode('check_email')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->scalarNode('layout_template')->defaultValue('CCDNComponentCommonBundle:Layout:layout_body_right.html.twig')->end()
                            ->end()
                        ->end()
                        ->arrayNode('reset')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->scalarNode('layout_template')->defaultValue('CCDNComponentCommonBundle:Layout:layout_body_right.html.twig')->end()
                                ->scalarNode('form_theme')->defaultValue('CCDNUserUserBundle:Form:fields.html.twig')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     *
     * @access private
     * @param ArrayNodeDefinition $node
     */
    private function addSecuritySection(ArrayNodeDefinition $node)
    {
        $node
            ->addDefaultsIfNotSet()
            ->canBeUnset()
            ->children()
                ->arrayNode('security')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->arrayNode('login')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->scalarNode('layout_template')->defaultValue('CCDNComponentCommonBundle:Layout:layout_single_column.html.twig')->end()
                                ->scalarNode('support_facebook')->defaultValue(false)->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     *
     * @access private
     * @param ArrayNodeDefinition $node
     */
    private function addLegalSection(ArrayNodeDefinition $node)
    {
        $node
            ->addDefaultsIfNotSet()
            ->canBeUnset()
            ->children()
                ->arrayNode('legal_documents')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->scalarNode('terms_conditions')->defaultValue('CCDNUserUserBundle:Legal:terms_conditions.txt.twig')->end()
                        ->scalarNode('copyright_notice')->defaultValue('CCDNUserUserBundle:Legal:copyright_notice.txt.twig')->end()
                        ->scalarNode('privacy_policy')->defaultValue('CCDNUserUserBundle:Legal:privacy_policy.txt.twig')->end()
                        ->scalarNode('disclaimer')->defaultValue('CCDNUserUserBundle:Legal:disclaimer.txt.twig')->end()
					->end()
				->end()
				->arrayNode('legal_identification')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
					->children()
						->scalarNode('company_name')->defaultValue('')->end()
						->scalarNode('show_company_name')->defaultValue(false)->end()

						->scalarNode('company_address')->defaultValue('')->end()
						->scalarNode('show_company_address')->defaultValue(false)->end()

						->scalarNode('company_registered_number')->defaultValue('')->end()
						->scalarNode('show_company_registered_number')->defaultValue(false)->end()

						->scalarNode('company_registered_house')->defaultValue('')->end()
						->scalarNode('show_company_registered_house')->defaultValue(false)->end()

						->scalarNode('copyright_year')->defaultValue('')->end()
						->scalarNode('show_copyright_year')->defaultValue(false)->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     *
     * @access private
     * @param ArrayNodeDefinition $node
     */
    private function addSidebarSection(ArrayNodeDefinition $node)
    {
        $node
            ->addDefaultsIfNotSet()
            ->canBeUnset()
            ->children()
                ->arrayNode('sidebar')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->arrayNode('links')
                            ->prototype('array')
                                ->children()
                                    ->scalarNode('bundle')->end()
                                    ->scalarNode('label')->end()
                                    ->scalarNode('route')->defaultNull()->end()
                                    ->scalarNode('path')->defaultNull()->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
}
