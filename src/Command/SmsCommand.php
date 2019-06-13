<?php

namespace MedBrief\CoreBundle\Command;

use MedBrief\CoreBundle\Sms\Service\SmsServiceProvider;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use MedBrief\CoreBundle\Sms\Sms;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

class SmsCommand extends ContainerAwareCommand
{

    /**
     * bin/console mb-core-sms:run process-sms-queue [provider name]
     * 
     * @return void
     */
    protected function configure() 
    {
        $this
            ->setName('mb-core-sms:run')
            ->setDescription('SMS processing')
            ->addArgument('action', InputArgument::REQUIRED, 'Name of action to run.')
            ->addArgument('provider', InputArgument::OPTIONAL, 'Name of service provider to use(bulksms|panacea-mobile).');
        ;
    }
    
    /**
     * Get service provider
     * 
     * @param string $name
     * @return SmsServiceProvider | false
     */
    protected function _getServiceProvider($name)
    {
        try {
            
            //replace dashes with _scores
            $name = str_replace('-', '_', $name);
            $service = $this->getContainer()->get("mb_core.sms.services.$name");
            
        } catch (ServiceNotFoundException $ex) {

            $service = false;
        } catch (\Exception $ex){
            
            $service = false;
        }
        
        return $service;
    }

    /**
     * 
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output) 
    {
        
        //name of action to run
        $action = $input->getArgument('action');
        
        //name of service provider to use
        $smsServiceName = $input->getArgument('provider');
        
        //var_dump($this->getContainer()->get('mncedi'));die;
        
        if (is_null($smsServiceName)) {
            
            //default to bulksms
            $smsServiceName = 'bulksms';
        }
        
        //get service to use
        $smsService = $this->_getServiceProvider($smsServiceName);
        if (false == $smsService) {
            
            $output->writeln("Unknown service provider: $smsServiceName");
            exit();
        }
        
        //user feedback message
        $outputMessage = '';
        
        switch ($action) {
            
            case 'process-sms-queue':
                
                //get our sms cron 
                $sms = $this->getContainer()->get('mb_core.sms.cron');
                
                //set the service provider
                $sms->setServiceProvider($smsService);
                
                $response = $sms->processQueue();
                
                $outputMessage = "Processed $response sms using {$smsService->getName()} service provider.";
                break;
            
            default:
                
                //invalid reminder name
                $outputMessage = "unknown action: '$action', expecting one of "
                    . "[process-sms-queue]";
                break;
        }
        
        $output->writeln($outputMessage);
    }
}