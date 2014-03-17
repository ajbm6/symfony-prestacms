@application @backend
Feature: Theme Administration
    In order to manage themes
    I need to be able to list, read and update themes

    Scenario: An admin see a list of themes
        Given I am connected with "admin" and "admin" on "/admin"
        When I follow dashboard "Themes" link "List"
        Then I should see 1 themes

    Scenario Outline: An admin view the details of a theme
        Given I am connected with "admin" and "admin" on "/admin/en/cms/theme"
        And I follow "creative"
        Then I should see the creative theme configuration
        And I can choose between "<website>" websites in "<locale>" locale

        Examples:
            | website           | locale |
            | symfony-prestacms | fr     |
            | symfony-prestacms | en     |

