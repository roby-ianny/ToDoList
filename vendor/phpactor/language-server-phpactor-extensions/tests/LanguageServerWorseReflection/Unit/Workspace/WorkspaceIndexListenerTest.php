<?php

namespace Phpactor\Extension\LanguageServerWorseReflection\Tests\Unit\Workspace;

use Phpactor\LanguageServerProtocol\TextDocumentIdentifier;
use Phpactor\LanguageServerProtocol\VersionedTextDocumentIdentifier;
use Phly\EventDispatcher\EventDispatcher;
use Phpactor\Extension\LanguageServerWorseReflection\Workspace\WorkspaceIndex;
use Phpactor\Extension\LanguageServerWorseReflection\Workspace\WorkspaceIndexListener;
use Phpactor\LanguageServer\Event\TextDocumentClosed;
use Phpactor\LanguageServer\Event\TextDocumentOpened;
use Phpactor\LanguageServer\Event\TextDocumentUpdated;
use Phpactor\LanguageServer\Test\ProtocolFactory;
use Phpactor\TestUtils\PHPUnit\TestCase;
use Phpactor\TextDocument\TextDocumentBuilder;
use Phpactor\TextDocument\TextDocumentUri;

class WorkspaceIndexListenerTest extends TestCase
{
    /**
     * @var ObjectProphecy
     */
    private $index;

    /**
     * @var EventDispatcher
     */
    private $dispatcher;

    protected function setUp(): void
    {
        $this->index = $this->prophesize(WorkspaceIndex::class);
        $this->dispatcher = new EventDispatcher(
            new WorkspaceIndexListener(
                $this->index->reveal()
            )
        );
    }

    public function testOpened()
    {
        $item = ProtocolFactory::textDocumentItem('/barfoo', 'foobar');
        $this->dispatcher->dispatch(new TextDocumentOpened(
            $item
        ));

        $this->index->index(
            TextDocumentBuilder::create('foobar')
                ->uri('/barfoo')
                ->language('php')
                ->build()
        )->shouldHaveBeenCalled();
    }

    public function testUpdated(): void
    {
        $item = new VersionedTextDocumentIdentifier('/barfoo');
        $this->dispatcher->dispatch(new TextDocumentUpdated(
            $item,
            'foobar',
        ));

        $this->index->update(
            TextDocumentUri::fromString('/barfoo'),
            'foobar'
        )->shouldHaveBeenCalled();
    }

    public function testClosed()
    {
        $item = new TextDocumentIdentifier('/barfoo');
        $this->dispatcher->dispatch(new TextDocumentClosed(
            $item
        ));

        $this->index->remove(
            TextDocumentUri::fromString('/barfoo')
        )->shouldHaveBeenCalled();
    }
}
