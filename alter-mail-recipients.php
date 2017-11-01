<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use Grav\Common\Twig\Twig;
use Grav\Plugin\Email\Email;
use RocketTheme\Toolbox\Event\Event;
use Swift_RfcComplianceException;

class AlterMailRecipientsPlugin extends Plugin
{
    /**
     * @var Email
     */
    protected $email;

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'onEmailSend' => ['onEmailSend', 0]
        ];
    }


    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized()
    {
        // Don't proceed if we are in the admin plugin
        if ($this->isAdmin()) {
            return;
        }
    }


    /**
     * Set BCC
     */
    public function onEmailSend(Event $event)
    {
        if ($event['vars']['form']->name() == 'contact') {
            if ($event['vars']['form']->value('some-field-name') == 'some-value') {
                $event['params'] += array('bcc' => 'something@email.com');
            }
            else {
                $event['params'] += array('bcc' => 'some-other-email@email.com');       
            }
        }
    }
}
