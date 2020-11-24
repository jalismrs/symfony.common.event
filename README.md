# symfony.common.event

Adds Symfony event listener abstract class

## Test

`phpunit` or `vendor/bin/phpunit`

coverage reports will be available in `var/coverage`

## Use

### ConsoleEventListenerAbstract

```php
use Jalismrs\Symfony\Common\ConsoleEventListenerAbstract;
use Symfony\Contracts\EventDispatcher\Event;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class SomeEvent extends Event {

}

class SomeConsoleEventListener extends ConsoleEventListenerAbstract {
    public function onSomeEvent(
        SomeEvent $someEvent
    ): SomeEvent {
        $style = $this->getStyle();
        
        // do something
    
        return $someEvent;
    }
}

class SomeCommand extends Command {
    private EventDispatcherInterface $eventDispatcher;
    private SomeConsoleEventListener $someConsoleEventListener;

    protected function initialize(
        InputInterface $input,
        OutputInterface $output
    ): void {
        $style = new SymfonyStyle(
            $input,
            $output
        );
        
        $this->someConsoleEventListener->setStyle($style);
    }
    
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        $someConsoleEventListenerSomeEvent = [
            $this->someConsoleEventListener,
            'onSomeEvent',
        ];
    
        $this->eventDispatcher->addListener(
            SomeEvent::class,
            $someConsoleEventListenerSomeEvent,
        );
        
        $this->eventDispatcher->dispatch(
            new SomeEvent(),
        );
    
        $this->eventDispatcher->removeListener(
            SomeEvent::class,
            $someConsoleEventListenerSomeEvent,
        );
    
        return Command::SUCCESS;
    }
}
```
