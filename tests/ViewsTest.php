<?php

use Mira\DirectoryDoesNotExistException;
use Mira\Mira;

beforeEach(function() {
    $this->views = new Mira(__DIR__ . '/views');
});

it("throws exception", function () {
    new Mira(__DIR__ . '/dir/does/not/exist');
})->throws(DirectoryDoesNotExistException::class, 'Directory ' . __DIR__ . '/dir/does/not/exist' . ' does not exist');

it('exists', function() {
    expect($this->views)->toBeInstanceOf(Mira::class);
});

it("renders a view", function() {
    $viewStr = $this->views->render("test");
    $this->assertEquals($viewStr, "hi");
});

it("renders an empty string for non-existent view", function() {
    $viewStr = $this->views->render("test4");
    $this->assertEquals($viewStr, "");
});

it("renders a section", function() {
    $viewStr = $this->views->render("test_with_section");
    $this->assertEquals($viewStr, "section");
});

it("renders with non-existent section", function() {
    $viewStr = $this->views->render("test_with_fake_section");
    $this->assertEquals($viewStr, "");
});

it("renders a view with param", function() {
    $viewStr = $this->views->render("test_with_params", ['foo' => 'bar']);
    $this->assertEquals($viewStr, "bar");
});